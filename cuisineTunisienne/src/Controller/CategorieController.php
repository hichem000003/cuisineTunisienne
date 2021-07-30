<?php

namespace App\Controller;

use phpDocumentor\Reflection\Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\CategorieRepository;
use App\Entity\Categorie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Serializer;

class CategorieController extends ApiController
{



    /**
     * @Route("/api/listcatg", name="listcateg")
     */
    public function getAllCatg(SerializerInterface $serializer): Response
    {
        $listp=$this->getDoctrine()->getRepository(Categorie::class)->findAll();
        $jsonContent = $serializer->serialize($listp,"json");
        return new Response($jsonContent);
    }





    /**
     * @Route("/api/categorie/{id}", name="categorie")
     */
    public function getCategorieById($id,SerializerInterface $serializer): Response
    {
        $categorie=$this->getDoctrine()->getRepository(Categorie::class)->find($id);
        $jsonContent = $serializer->serialize($categorie,"json");
        return new Response($jsonContent);
    }



    /**
     * @Route("/api/addCategorie", name="addCategorie")
     */
    public function addCategorie(Request $request,SerializerInterface $serializer) :
    Response {
        $data=$request->getContent();
        $categorie = $serializer->deserialize($data, Categorie::class, 'json');
        $em=$this->getDoctrine()->getManager();
        $em->persist($categorie);
        $em->flush();
        $jsonContent = $serializer->serialize($categorie,"json");
        return new Response($jsonContent);
    }


    /**
     * @Route("/delete/{id}", name="evenement_delete")
     * @return Response
     */
   /* public function delete($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $categorie=$em->getRepository(Categorie::class)->find($id);
        $em->remove($categorie);
        $em->flush();
        $response= new Response('',Response::HTTP_OK );
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'DELETE');
        return $response;


    }
*/

    /**
     * @Route("/api/delet/{id}", name="delete2" )
     */
    public function deleteIngredient ($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository(Categorie::class)->find($id);
        $em ->remove($categorie);
        $em->flush();
        $response=new Response('',Response::HTTP_OK);
        return $response ;

    }



    /**
     * @Route("/api/update/{id}", name="update" )
     */
    public function UpdateCategorie (Request $request,$id,CategorieRepository  $categorieRepository):Response
    {
        $data=$request->getContent();
        $serializer=$this->Serializer();
        $employeV1= $serializer->deserialize($data,'App\Entity\Categorie', 'json');
        $em=$this->getDoctrine()->getManager();
        $employeV0=$categorieRepository->find($id);
        $employeV0->setRefCategorie($employeV1->getRefCategorie());
        $employeV0->setNomCategorie($employeV1->getNomCategorie());
        $em->persist( $employeV0);
        $em->flush();
        $response = new Response('', Response::HTTP_OK);
        return $response;

    }









}
