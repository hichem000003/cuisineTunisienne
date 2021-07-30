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
use App\Entity\User;


class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserController.php',
        ]);
    }
	/**
	* @Route("/users", name="listusers", methods={"GET"})
	*/
	public function getAllUsers(SerializerInterface $serializer): Response
	{
		$listu=$this->getDoctrine()->getRepository(User::class)->findAll();
		$jsonContent = $serializer->serialize($listu,"json");
		return new Response($jsonContent);
	}
	
	/**
	* @Route("/users/{id}", name="user", methods={"GET"})
	*/
	public function getUzer($id,SerializerInterface $serializer): Response
	{
		$user=$this->getDoctrine()->getRepository(User::class)->find($id);
		$jsonContent = $serializer->serialize($user, 'json');
		return new Response($jsonContent);
	}
	
	/**
	* @Route("/user", name="addUser", methods={"POST"})
	
	public function addUser(Request $request,SerializerInterface $serializer): Response 
	{
		//récupérer le contenu de la requête envoyé
		$data=$request->getContent();
		$user = $serializer->deserialize($data, User::class, 'json');
		$em=$this->getDoctrine()->getManager();
		$em->persist($user);
		$em->flush();
		$jsonContent = $serializer->serialize($user,"json");
		return new Response($jsonContent);
	}
	*/
	
	/**
	* @Route("/user/{id}", name="deleteUser", methods={"DELETE"})
	*/
	public function deleteUser($id, SerializerInterface $serializer): Response
	{
		$entityManager = $this->getDoctrine()->getManager();
		$user=$this->getDoctrine()->getRepository(User::class)->find($id);
		$entityManager->remove($user);
        $entityManager->flush();
		$jsonContent = $serializer->serialize($user,"json");
		return new Response($jsonContent);
	}
	
	/**
	* @Route("/user/{id}", name="updateUser", methods={"PUT"})
	*/
	public function updateUser($id, SerializerInterface $serializer, Request $request): Response
    {
		$data=$request->getContent();
		$user = $serializer->deserialize($data, User::class, 'json');
		$user->setId($id);
		$entityManager = $this->getDoctrine()->getManager();
        $entityManager->merge($user);
        $entityManager->flush();
		$jsonContent = $serializer->serialize($user,"json");
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
	* @Route("/user", name="addUser", methods={"POST"})
	*/
	public function addUser(Request $request): Response
    {
        $data = $request->getContent();
        $dataJson = json_decode($request->getContent(), true);
        $encoders = array(new JsonEncoder());
        $serializer= new Serializer([new ObjectNormalizer()],$encoders);
        $user = $serializer->deserialize($data,User::class,'json');
        $entityManager = $this->getDoctrine()->getManager();
		$entityManager->persist($user);
        $entityManager->flush();
        $jsonContent = $serializer->serialize($user,"json");
        return new Response($jsonContent);
    }

}
