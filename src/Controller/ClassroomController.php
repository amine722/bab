<?php

namespace App\Controller;
use App\Entity\Classroom;
use App\Form\ClassroomType;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ClassroomRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use  App\Entity\etudiant;
class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }

    #[Route('/affiche', name: 'affiche')]

    function affiche(ClassroomRepository $repository)
    {
        $classroom=$repository->findAll();
        return $this->render('classroom/affiche.html.twig',['classroom'=>$classroom]);
    }
        
        #[Route('/suppc/{id}', name: 'supprimerc')]
      public function suppc(ManagerRegistry $doctrine,$id,ClassroomRepository $repository)
      {     //recuperer le classroom a supprimer
           $classroom=$repository->find($id);
           //recuperer l'entity manager
           $em= $doctrine->getManager();
           $em->remove($classroom);
           $em->flush();
           return $this->redirectToRoute("affiche");

            
      }
      
      #[Route('/addclassroom', name: 'addclassroom')]

    public function addclassroom(ManagerRegistry $doctrine,Request $request)
    {
        $classroom=new Classroom();
        $form=$this->createForm(ClassroomType::class,$classroom);
        $form->add('add',SubmitType::class);
        $form->handleRequest($request);
        //Action d'ajout
        if($form->isSubmitted()){ 
            $em =$doctrine->getManager() ;
            $em->persist($classroom);
            $em->flush();
            return $this->redirectToRoute("affiche");
        }
            return $this->render('classroom/add.html.twig',['form'=>$form->createView()]);
          }
          
          #[Route('/updatec/{id}', name: 'updatec')]
          public function updatec(ManagerRegistry $doctrine,$id,ClassroomRepository $repository,Request $request)
          {     //recuperer le classroom a supprimer
               $classroom=$repository->find($id);
              $form=$this->createForm(ClassroomType::class,$classroom);
              $form->add('Update',SubmitType::class);
              $form->handleRequest($request);
              if($form->isSubmitted()){ 
                $em =$doctrine->getManager() ;
                $em->flush();
                return $this->redirectToRoute("affiche");
            }
                return $this->render('classroom/update.html.twig',['form'=>$form->createView()]);
                
          }
          

    }
        



