<?php
/**
 * Created by PhpStorm.
 * User: Fab
 * Date: 26/10/17
 * Time: 11:31
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class StageController extends AbstractController
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
    public function listStages()
    {

        $doctrine = $this->getDoctrine();
        $repo = $doctrine->getRepository('App:Stage');
        $stages = $repo->findAll();

        return $this->render('stages/stages.html.twig',['stages'=>$stages]);

    }




}