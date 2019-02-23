<?php
/**
 * Created by PhpStorm.
 * User: Fab
 * Date: 9/01/18
 * Time: 19:48
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class SearchController extends Controller  {
    /**
     *
     * RENVOIE UNE LISTE DE PRESTATAIRE SUITE UTILISATION MODULE DE RECHERCHE
     *
     * @Route("/search", name="search")
     *
     */
    public function searchProviders(Request $request)
    {


        $params['by_name'] = $request->query->get('by_name');
        $params['by_location'] = $request->query->get('by_locality');
        $params['by_service'] = $request->query->get('by_service');


        $doctrine = $this->getDoctrine();

        $repo = $doctrine->getRepository('App:Provider');
        $repo_service = $doctrine->getRepository('App:Service');

        $services = $repo_service->findAll();

        $providers = $repo->search($params);


        $paginator = $this->get('knp_paginator');


        $result = $paginator->paginate(
            $providers,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 4)
        );


        return $this->render('providers/providers.html.twig',
            ['providers' => $result, 'services' => $services, 'params' => $params]);

    }
}