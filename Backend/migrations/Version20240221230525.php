<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240221230525 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE memo (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, place_id INT DEFAULT NULL, note LONGTEXT DEFAULT NULL, visited_date DATE DEFAULT NULL, INDEX IDX_AB4A902AA76ED395 (user_id), INDEX IDX_AB4A902ADA6A219 (place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, memo_related_id INT DEFAULT NULL, path VARCHAR(255) NOT NULL, INDEX IDX_14B784183B2A1D80 (memo_related_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE memo ADD CONSTRAINT FK_AB4A902AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE memo ADD CONSTRAINT FK_AB4A902ADA6A219 FOREIGN KEY (place_id) REFERENCES place (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784183B2A1D80 FOREIGN KEY (memo_related_id) REFERENCES memo (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE memo DROP FOREIGN KEY FK_AB4A902AA76ED395');
        $this->addSql('ALTER TABLE memo DROP FOREIGN KEY FK_AB4A902ADA6A219');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784183B2A1D80');
        $this->addSql('DROP TABLE memo');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE user');
    }
}
