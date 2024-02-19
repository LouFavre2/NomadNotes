<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219141117 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, memo_id INT DEFAULT NULL, path VARCHAR(255) NOT NULL, INDEX IDX_14B78418B4D32439 (memo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place_memo (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, place_id INT DEFAULT NULL, note LONGTEXT NOT NULL, visited_date DATE DEFAULT NULL, INDEX IDX_61FFE0C6A76ED395 (user_id), INDEX IDX_61FFE0C6DA6A219 (place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418B4D32439 FOREIGN KEY (memo_id) REFERENCES place_memo (id)');
        $this->addSql('ALTER TABLE place_memo ADD CONSTRAINT FK_61FFE0C6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE place_memo ADD CONSTRAINT FK_61FFE0C6DA6A219 FOREIGN KEY (place_id) REFERENCES place (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418B4D32439');
        $this->addSql('ALTER TABLE place_memo DROP FOREIGN KEY FK_61FFE0C6A76ED395');
        $this->addSql('ALTER TABLE place_memo DROP FOREIGN KEY FK_61FFE0C6DA6A219');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE place_memo');
    }
}
