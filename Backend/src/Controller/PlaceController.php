<?php

namespace App\Controller;

use App\Entity\Memo;
use App\Entity\Photo;
use App\Entity\Place;
use App\Repository\PlaceRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class PlaceController extends AbstractController
{

    #[Route('/api/places', name: 'get_places', methods: ['GET'])]
    public function getPlaces(PlaceRepository $placeRepository): JsonResponse
    {
        $user = $this->getUser();

        if(!$user) {
            return $this->json(['message' => 'User not authenticated'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        $places = $placeRepository->findPlacesByUser($user);

        $placesData = [];
        foreach ($places as $place) {
            $placesData[] = [
                'name' => $place->getName(),
                'latitude' => $place->getLatitude(),
                'longitude' => $place->getLongitude(),
            ];
        }

        return new JsonResponse([
            $placesData,
            JsonResponse::HTTP_OK
        ]);
    }



    #[Route('/api/places', name: 'add_place', methods: ['POST'])]
    public function createPlace(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);


        if (!isset($data['name'], $data['latitude'], $data['longitude'], $data['note'])) {
            return new JsonResponse(['message' => 'Missing required fields'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $place = new Place();
        $place->setName($data['name']);
        $place->setLatitude($data['latitude']);
        $place->setLongitude($data['longitude']);


        $memo = new Memo();
        $memo->setUser($this->getUser());
        $memo->setPlace($place);
        $memo->setNote($data['note']);
        $memo->setVisitedDate(new DateTime($data['date_visite']));

        foreach ($data['photos'] as $photoLink) {
            $photo = new Photo();
            $photo->setPath($photoLink);
            $memo->addPhoto($photo);
        }

        $em->persist($place);
        $em->persist($memo);
        $em->flush();

        return new JsonResponse([
            'message' => 'Nouveau lieu créé avec succès',
            JsonResponse::HTTP_CREATED
        ]);
    }


    //TODO: Ajouter sécurité, supprimer que ses markers
    #[Route('/api/places/{id}', name: 'delete_place', methods: ['DELETE'])]
    public function deletePlace(Place $place = null, EntityManagerInterface $em): JsonResponse
    {
        if (!$place) {
            return new JsonResponse(['message' => 'Lieu non trouvé'], JsonResponse::HTTP_NOT_FOUND);
        }

        foreach ($place->getMemos() as $memo) {
            foreach ($memo->getPhotos() as $photo) {
                $em->remove($photo);
            }
            $em->remove($memo);
        }

        $em->remove($place);
        $em->flush();

        return new JsonResponse([
            'message' => 'Lieu supprimé avec succès'],
            JsonResponse::HTTP_OK);
    }

}
