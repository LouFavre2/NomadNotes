<?php

namespace App\Controller;

use App\Entity\Memo;
use App\Entity\Photo;
use App\Entity\Place;
use App\Repository\MemoRepository;
use App\Repository\PlaceRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class MemoController extends AbstractController
{
    #[Route('/api/memos', name: 'get_memos', methods: ['GET'])]
    public function getMemos(MemoRepository $memoRepository): JsonResponse
    {
        $user = $this->getUser();

        if(!$user) {
            return $this->json(['message' => 'Utilisateur non authentifié'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        $memos = $memoRepository->findMemosByUser($user);

        $memosData = [];
        foreach ($memos as $memo) {
            $memosData[] = [
                'id' => $memo->getId(),
                'note' => $memo->getNote(),
                'place' => [
                    'id' => $memo->getPlace()->getId(),
                    'name' => $memo->getPlace()->getName(),
                ],
                'photos' => $memo->getPhotos()->map(function($photo) {
                    return [
                        'id' => $photo->getId(),
                        'url' => $photo->getPath()
                    ];
                })->toArray()

            ];
        }

        return new JsonResponse([
            '$memosData' => $memosData,
        ], JsonResponse::HTTP_OK);
    }
}