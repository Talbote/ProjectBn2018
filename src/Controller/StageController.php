<?php
/**
 * Created by PhpStorm.
 * User: Fab
 * Date: 26/10/17
 * Time: 11:31
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Form\StageType;
use App\Entity\Stage;
use App\Services\Persist;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class StageController extends Controller
{
    /**
     * LA PAGE D'UN STAGE
     *
     * @Route("stage/{slug}", name="show_stage")
     */
    public function showStage($slug){

        $doctrine = $this->getDoctrine();
        $repo = $doctrine->getRepository('App:Stage');
        $stage = $repo->stageWhithProvider($slug);

        return $this->render('stages/stage.html.twig',['stage'=>$stage]);

    }

    /**
     *
     *  LISTE DES STAGES
     *
     * @Route("stages/list", name="list_stages")
     */
    public function listStages(Request $request)
    {

        $doctrine = $this->getDoctrine();
        $repo = $doctrine->getRepository('App:Stage');
        $stages = $repo->findAll();


        /*
         * Pagination
         */
        $paginator = $this->get('knp_paginator');
        $stages_pages = $paginator->paginate(
            $stages, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            8/*limit per page*/
        );

        return $this->render('stages/stages.html.twig',['stages'=>$stages_pages,]);

    }

    /**
     * gestion stages pour un provider
     * @Route("/user/my_stages", name="my_stages")
     * @Method({"GET"})
     */
    public function providerStagesAction()
    {
        /*
         * Récupération prestataire loggé
         * Querybuilder pour récupéré les stage associés à son ID
         */
        $user = $this->getUser();


        $doctrine = $this->getDoctrine();
        $repo_stages = $doctrine->getRepository('App:Stage');
        $stages = $repo_stages -> stagesProvider($user);
        //dump($repo_stages);die;

        return $this->render('providers/gestions/management_stages.html.twig', [
            'stages' => $stages,
            'user' => $user
        ]);
    }

    /**
     * Provider Création d'un stage pour un provider
     * @Route("/user/my_stages/new",name="new_stage")
     * @Method({"GET", "POST"})
     *
     */
    public function createStageAction(Request $request, Persist $persist)
    {
        $stage = new Stage();
        $user = $this->getUser();

        $form_stage = $this->createForm(StageType::class, $stage, ['method' => 'POST']);
        $form_stage->handleRequest($request);

        if ($form_stage->isSubmitted()){

            if ($form_stage->isValid()) {

                $stage -> setProvider($user);

                $persist -> persist($stage);

                $this->addFlash('success', 'Stage created!');
                return $this->redirectToRoute('my_stages');

            } else {
                $this->addFlash('error', 'Erreur dans votre formulaire de stage !');
            }
        }

        return $this->render('providers/gestions/create_stage/create_stage_provider.html.twig',[
            'form_stage' => $form_stage->createView(),
            'user' => $user
        ]);
    }

    /**
     * Modifier un stage d'un provider
     * @Route("/user/my_stages/edit/{slug}",name="edit_stage")
     * @Method({"GET", "POST"})
     */
    public function editStageAction(Request $request,Persist $persist, $slug)
    {
        $user = $this->getUser();

        $doctrine = $this->getDoctrine();
        $stage = $doctrine->getRepository('App:Stage')->findOneBy(['slug' => $slug]);

        $form_stage = $this->createForm(StageType::class, $stage, ['method' => 'POST']);
        $form_stage->handleRequest($request);

        if ($form_stage->isSubmitted()){

            if ($form_stage->isValid()) {

                $persist -> flush();

                $this->addFlash('success', 'Stage Updated');
                return $this->redirectToRoute('my_stages');

            } else {
                $this->addFlash('error', 'Erreur dans votre formulaire de stage !');
            }
        }

        return $this->render('providers/gestions/create_stage/create_stage_provider.html.twig', [
            'form_stage' => $form_stage->createView(),
            'user' => $user
        ]);
    }

    /**
     * Suppresion d'un stage d'un provider
     * @Route("/user/my_stages/delete/{slug}",name="delete_stage")
     * @Method("GET")
     */
    public function deleteStageAction( Persist $persist, $slug)
    {
        $doctrine = $this->getDoctrine();
        $stage = $doctrine->getRepository('App:Stage')->findOneBy(['slug' => $slug]);

        $persist -> remove($stage);

        return $this->redirectToRoute('my_stages');

    }



}