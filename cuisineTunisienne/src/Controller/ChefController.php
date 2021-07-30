<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use App\Entity\Chef;
use App\Repository\AbonnementRepository;


class ChefController extends AbstractController
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
	* @Route("/chefs", name="listchefs", methods={"GET"})
	*/
	public function getAllChefs(SerializerInterface $serializer): Response
	{
		$listc=$this->getDoctrine()->getRepository(Chef::class)->findAll();
		$jsonContent = $serializer->serialize($listc,"json", [
			'circular_reference_handler' => function ($object) {
				return $object->getId();
			}
		]);
		return new Response($jsonContent);
	}
	
	/**
	* @Route("/chefs/{id}", name="chef", methods={"GET"})
	*/
	public function getChef($id,SerializerInterface $serializer): Response
	{
		$chef=$this->getDoctrine()->getRepository(Chef::class)->find($id);
		$jsonContent = $serializer->serialize($chef, 'json', [
			'circular_reference_handler' => function ($object) {
				return $object->getId();
			}
		]);
		return new Response($jsonContent);
	}
	
	/**
	* @Route("/chef", name="addChef", methods={"POST"})
	
	public function addChef(Request $request,SerializerInterface $serializer): Response 
	{
		//récupérer le contenu de la requête envoyé
		$data=$request->getContent();
		$chef = $serializer->deserialize($data, Chef::class, 'json');
		$em=$this->getDoctrine()->getManager();
		$em->persist($chef);
		$em->flush();
		$jsonContent = $serializer->serialize($chef,"json");
		return new Response($jsonContent);
	}
	*/
	
	public function addAbonnement(Request $request,SerializerInterface $serializer): Response 
	{
		//récupérer le contenu de la requête envoyé
		$data=$request->getContent();
		$abonnement = $serializer->deserialize($data, Abonnement::class, 'json');
		$em=$this->getDoctrine()->getManager();
		$em->persist($abonnement);
		$em->flush();
		$jsonContent = $serializer->serialize($abonnement,"json");
		return new Response($jsonContent);
	}
	
	/**
	* @Route("/chef/{id}", name="deleteChef", methods={"DELETE"})
	*/
	public function deleteChef($id, SerializerInterface $serializer): Response
	{
		$entityManager = $this->getDoctrine()->getManager();
		$chef=$this->getDoctrine()->getRepository(Chef::class)->find($id);
		$entityManager->remove($chef);
        $entityManager->flush();
		$jsonContent = $serializer->serialize($chef,"json");
		return new Response($jsonContent);
	}
	
	/**
	* @Route("/chef/{id}", name="updateChef", methods={"PUT"})
	*/
	public function updateChef($id, SerializerInterface $serializer, Request $request): Response
    {
		$data=$request->getContent();
		$chef = $serializer->deserialize($data, Chef::class, 'json');
		$chef->setId($id);
		$entityManager = $this->getDoctrine()->getManager();
        $entityManager->merge($chef);
        $entityManager->flush();
		$jsonContent = $serializer->serialize($chef,"json");
        return new Response($jsonContent);
    }
	
	/*
	public function addParticipation(Request $request, MembreRepository $membreRepository,EvenementRepository $evenementRepository): Response
    {
        $data = $request->getContent();
        $dataJson = json_decode($request->getContent(), true);
        $encoders = array(new JsonEncoder());
        $serializer= new Serializer([new ObjectNormalizer()],$encoders);
        $participation = $serializer->deserialize($data,Participation::class,'json',[AbstractNormalizer::IGNORED_ATTRIBUTES => ['evenement',"membre"]]);
        $entityManager = $this->getDoctrine()->getManager();
		$membre=$membreRepository->find($dataJson['membre']);
		$evenement=$evenementRepository->find($dataJson['evenement']);
        $participation->setEvenement($evenement);                    
        $participation->setMembre($membre);
		$entityManager->persist($participation);
        $entityManager->flush();
        return $this->crudAPI->managerAction();

    }*/
	
	/**
	* @Route("/chef", name="addChef", methods={"POST"})
	*/
	public function addChef(Request $request, AbonnementRepository $abonnementRepository): Response
    {
        $data = $request->getContent();
        $dataJson = json_decode($request->getContent(), true);
        $encoders = array(new JsonEncoder());
        $serializer= new Serializer([new ObjectNormalizer()],$encoders);
        $chef = $serializer->deserialize($data,Chef::class,'json',[AbstractNormalizer::IGNORED_ATTRIBUTES => ['abonnements']]);
        $entityManager = $this->getDoctrine()->getManager();
		$entityManager->persist($chef);
        $entityManager->flush();
        $jsonContent = $serializer->serialize($chef,"json");
        return new Response($jsonContent);
    }

}
