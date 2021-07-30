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
use App\Entity\Membre;
use App\Repository\AbonnementRepository;

class MembreController extends AbstractController
{
   /**
     * @Route("/membre", name="membre")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ChefController.php',
        ]);
    }
	/**
	* @Route("/membres", name="listmembres", methods={"GET"})
	*/
	public function getAllMembres(SerializerInterface $serializer): Response
	{
		$listm=$this->getDoctrine()->getRepository(Membre::class)->findAll();
		$jsonContent = $serializer->serialize($listm,"json", [AbstractNormalizer::IGNORED_ATTRIBUTES => ['abonnements']]);
		return new Response($jsonContent);
	}
	
	/**
	* @Route("/membres/{id}", name="membre", methods={"GET"})
	*/
	public function getMembre($id,SerializerInterface $serializer): Response
	{
		$membre=$this->getDoctrine()->getRepository(Membre::class)->find($id);
		$jsonContent = $serializer->serialize($membre, 'json', [
			'circular_reference_handler' => function ($object) {
				return $object->getId();
			}
		]);
		return new Response($jsonContent);
	}
	
	/**
	* @Route("/membre/{id}", name="deleteMembre", methods={"DELETE"})
	*/
	public function deleteMembre($id, SerializerInterface $serializer): Response
	{
		$entityManager = $this->getDoctrine()->getManager();
		$membre=$this->getDoctrine()->getRepository(Membre::class)->find($id);
		$entityManager->remove($membre);
        $entityManager->flush();
		$jsonContent = $serializer->serialize($membre,"json", [AbstractNormalizer::IGNORED_ATTRIBUTES => ['abonnements']]);
		return new Response($jsonContent);
	}
	
	/**
	* @Route("/membre/{id}", name="updateMembre", methods={"PUT"})
	*/
	public function updateMembre($id, SerializerInterface $serializer, Request $request): Response
    {
		$data=$request->getContent();
		$membre = $serializer->deserialize($data, Membre::class, 'json');
		$membre->setId($id);
		$entityManager = $this->getDoctrine()->getManager();
        $entityManager->merge($membre);
        $entityManager->flush();
		$jsonContent = $serializer->serialize($membre,"json");
        return new Response($jsonContent);
    }
	
	/**
	* @Route("/membre", name="addMembre", methods={"POST"})
	*/
	public function addMembre(Request $request, AbonnementRepository $abonnementRepository): Response
    {
        $data = $request->getContent();
        $dataJson = json_decode($request->getContent(), true);
        $encoders = array(new JsonEncoder());
        $serializer= new Serializer([new ObjectNormalizer()],$encoders);
        $membre = $serializer->deserialize($data,Membre::class,'json',[AbstractNormalizer::IGNORED_ATTRIBUTES => ['abonnements']]);
        $entityManager = $this->getDoctrine()->getManager();
		$entityManager->persist($membre);
        $entityManager->flush();
        $jsonContent = $serializer->serialize($membre,"json");
        return new Response($jsonContent);
    }
}
