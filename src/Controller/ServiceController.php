<?php

namespace App\Controller;

use App\Entity\Service;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ServiceType;


class ServiceController extends Controller  {

    /**
     *
     * affiche la description d'un service et la liste des providers liés aux services
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
    public function listServices(Request $request){

        $doctrine = $this->getDoctrine();
        $repo = $doctrine->getRepository('App:Service');
        $services = $repo->findServiceWithImage();

        /*
         * Pagination
         */
        $paginator = $this->get('knp_paginator');
        $services_pages = $paginator->paginate(
            $services, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/
        );

        return $this->render('services/services.html.twig',['services'=>$services_pages]);


    }


}