<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use JMS\Serializer\Annotation\VirtualProperty;

use App\Repository\MembreRepository;
use App\Repository\ChefRepository;


use App\Entity\Abonnement;

class AbonnementController extends AbstractController
{
    /**
     * @Route("/chef", name="chef")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ChefController.php',
        ]);
    }
	/**
	* @Route("/abonnements", name="listabonnements", methods={"GET"})
	*/
	public function getAllAbonnements(SerializerInterface $serializer): Response
	{
		$lista=$this->getDoctrine()->getRepository(Abonnement::class)->findAll();
		$jsonContent = $serializer->serialize($lista, 'json',[AbstractNormalizer::IGNORED_ATTRIBUTES => ['chef','membre']]);		
		return new Response($jsonContent);
	}
	
	/**
	* @Route("/abonnements/{id}", name="abonnement", methods={"GET"})
	*/
	public function getAbonnement($id,SerializerInterface $serializer): Response
	{
		$abonnement=$this->getDoctrine()->getRepository(Abonnement::class)->find($id);
		$jsonContent = $serializer->serialize($abonnement, 'json', [
			'circular_reference_handler' => function ($object) {
				return $object->getId();
			}
		]);
		return new Response($jsonContent);
	}
	
	/**
	* @Route("/abonnement", name="addAbonnement", methods={"POST"})
	*/
	public function addAbonnement(Request $request,MembreRepository $membreRepository, ChefRepository $chefRepository): Response 
	{
		$data=$request->getContent();
		$dataJson = json_decode($request->getContent(), true);
		$encoder = new JsonEncoder();
		$defaultContext = [
			AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
			return $object->getId();
		},
		];
		$normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);
		$serializer = new Serializer([$normalizer], [$encoder]);
		$abonnement = $serializer->deserialize($data, Abonnement::class, 'json',[AbstractNormalizer::IGNORED_ATTRIBUTES => ['dateAbonnement','chef','membre']]);
		$em=$this->getDoctrine()->getManager();
		$membre=$membreRepository->find($dataJson['membre']);
		$chef=$chefRepository->find($dataJson['chef']);
		$abonnement->setDateAbonnement(date('Y-m-d H:i:s'));
        $abonnement->setChef($chef);                    
        $abonnement->setMembre($membre);
		$em->persist($abonnement);
		$em->flush();
		$jsonContent = $serializer->serialize($abonnement,"json");
		return new Response($jsonContent);
	}
	
	/**
	* @Route("/abonnement/{id}", name="updateAbonnement", methods={"PUT"})
	*/
	public function updateAbonnement($id, Request $request,MembreRepository $membreRepository, ChefRepository $chefRepository): Response 
	{
		$data=$request->getContent();
		$dataJson = json_decode($request->getContent(), true);
		$encoder = new JsonEncoder();
		$defaultContext = [
			AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
			return $object->getId();
		},
		];
		$normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);
		$serializer = new Serializer([$normalizer], [$encoder]);
		$abonnement = $serializer->deserialize($data, Abonnement::class, 'json',[AbstractNormalizer::IGNORED_ATTRIBUTES => ['dateAbonnement','chef','membre']]);
		$em=$this->getDoctrine()->getManager();
		$membre=$membreRepository->find($dataJson['membre']);
		$chef=$chefRepository->find($dataJson['chef']);
		$abonnement->setId($id);
		$abonnement->setDateAbonnement(date('Y-m-d H:i:s'));
        $abonnement->setChef($chef);                    
        $abonnement->setMembre($membre);
		$em->merge($abonnement);
		$em->flush();
		$jsonContent = $serializer->serialize($abonnement,"json");
		return new Response($jsonContent);
	}

}
