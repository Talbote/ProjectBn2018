<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class ServiceController extends Controller {

    /**
     *
     * affiche la description d'un service et la liste des providers liés à celui-ci
     *
     * @Route("service/{slug}", name="show_service")
     *
     */
    public function showService(Request $request, $slug){

        $doctrine = $this->getDoctrine();
        $repo = $doctrine->getRepository('App:Service');
        $repo_provider = $doctrine->getRepository('App:Provider');


        $service = $repo->findOneBy(['slug'=>$slug]);

        $id = $service->getId();


        //requête pour lister les provider de ce service
        $providers = $repo_provider->myFindBy($id);

        $paginator = $this->get('knp_paginator');

        $result = $paginator->paginate(
            $providers,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 4)
        );

        return $this->render('services/service.html.twig', ['service'=>$service,  'providers'=>$result, 'id'=>$id]);


    }


    /**
     *
     * affiche la liste des services
     *
     * @Route("services/list", name="list_services")
     */
    public function listServices(){

        $doctrine = $this->getDoctrine();
        $repo = $doctrine->getRepository('App:Service');
        $services = $repo->findServiceWithImage();

        return $this->render('services/services.html.twig',['services'=>$services]);


    }




}