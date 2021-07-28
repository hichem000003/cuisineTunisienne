<?php

namespace App\Controller;
use App\Entity\Recette;
use App\Repository\CategorieRepository;
use App\Response\RecetteResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpFoundation\RequestStack;
use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use phpDocumentor\Reflection\Type;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Psr\Log\LoggerInterface;

use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Serializer;


class RecetteController extends ApiController
{

    /**
     * @Route("/api/ListRecettes" , name="recette", methods="GET")
     */

   /* public function getAllRecette( RecetteRepository  $RecetteRepository): JsonResponse
    {
        $serializer = $this->serializer();
        $recettes = $RecetteRepository->findAll();
        $jsonContent = $serializer->serialize($recettes,'json');
        return $this->response($jsonContent);}
*/


    /**
     * @Route("/findAllRecette", name="AllRecette")
     */
    public function index(RecetteRepository $recetteRepository): Response
    {
        $objects=$recetteRepository->findAll();
        $encoders=$arrayName = array(new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        // Add Circular reference handler
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);
        $data=$serializer->serialize($objects,'json');
        return new Response($data);

    }









    /**
     * @Route("/RecetteByID2/{id}", name="Recettebyid", methods={"GET"})
     */    public function show($id,RecetteRepository $recetteRepository): Response
{
    $object=$recetteRepository->find($id);
    $encoders=$arrayName = array(new JsonEncoder());
    $normalizer = new ObjectNormalizer();
    $normalizer->setCircularReferenceLimit(1);
    // Add Circular reference handler
    $normalizer->setCircularReferenceHandler(function ($object) {
        return $object->getId();
    });
    $normalizers = array($normalizer);
    $serializer = new Serializer($normalizers, $encoders);
    $data=$serializer->serialize($object,'json');
    return new Response($data);
}


    /**
     * @Route("deletRecette/{id}", name="delete" )
     */
    public function deleteRecette ($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $Recette = $em->getRepository(Recette::class)->find($id);
        $em ->remove($Recette);
        $em->flush();
        $response=new Response('',Response::HTTP_OK);
        return $response ;

    }




    /**
     * @Route("/updateRecette/{id}", name="update")
     */
   public function UpdateRecette (Request $request,$id,RecetteRepository $recetteRepository,RequestStack $requestStack,CategorieRepository $categorieRepository ):Response
    {

        $CategorieID = $requestStack->getCurrentRequest()->query->get('categoryID');
        $data=$request->getContent();
        $Categ=$categorieRepository->findOneBy(array('id' => $CategorieID));

        $serializer=$this->Serializer();
        $employeV1= $serializer->deserialize($data,'App\Entity\Recette', 'json');
        $em=$this->getDoctrine()->getManager();
        $employeV0=$recetteRepository->find($id);
        $employeV0->setRefRecette($employeV1->getRefRecette());
        $employeV0->setNomRecette($employeV1->getNomRecette());
        $employeV0->setTempsCuisson($employeV1->getTempsCuisson());
        $employeV0->setTempsPreparation($employeV1->getTempsPreparation());
        $employeV0->setPhoto($employeV1->getPhoto());
        $employeV0->setVideo($employeV1->getVideo());
        $employeV0->setNbPersonnes($employeV1->getNbPersonnes());
        $employeV0->setNiveauDifficulte($employeV1->getNiveauDifficulte());
        $employeV0->setCategories($Categ);

        $em->persist( $employeV0);
        $em->flush();
        $response = new Response('', Response::HTTP_OK);
        return $response;


    }


    /**
     * @Route("/AjoutRecette", name="Add",methods="POST")
     */
      public function AddRecette (Request $request,
                                  RecetteRepository $recetteRepository,
                                  RequestStack $requestStack,
                                  CategorieRepository $categorieRepository ,
                                  LoggerInterface $loger,
                                  RecetteResponse $recetteResponse ,
                                  EntityManagerInterface $em ):JsonResponse
      {


          $loger->info($request);

          $loger->info('Ffffffffffffff');
          $CategorieID = $requestStack->getCurrentRequest()->query->get('categoryID');

          $request = $this->transformJsonBody($request);
           if (! $request)
           { return $this->respondValidationError('Please provide a valid request!'); }

          $Categ=$categorieRepository->findOneBy(array('id' => $CategorieID));


          $recV0=new Recette();
          $recV0->setRefRecette($request->get('refRecette'));
          $recV0->setNomRecette($request->get('nomRecette'));
          $recV0->setTempsCuisson($request->get('tempsCuisson'));
          $recV0->setTempsPreparation($request->get('tempsPreparation'));
          $recV0->setPhoto($request->get('photo'));
          $recV0->setVideo($request->get('video'));
          $recV0->setNbPersonnes($request->get('nbPersonnes'));
          $recV0->setNiveauDifficulte($request->get('niveauDifficulte'));
          $recV0->setCategories($Categ);
          $em->persist( $recV0);
          $em->flush();

          return $this->respondCreated($recetteResponse->transform($recV0));


      }











}
