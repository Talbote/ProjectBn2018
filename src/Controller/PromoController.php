<?php
/**
 * Created by PhpStorm.
 * User: Fab
 * Date: 1/11/17
 * Time: 11:55
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



class PromoController extends Controller
{

    /**
     * AFFICHE LA LISTE DES PROMOTIONS
     *
     * @Route("promotions/list", name="list_promos")
     */
    public function listPromo(Request $request){

        $doctrine=$this->getDoctrine();
        $repo = $doctrine->getRepository('App:Promotion');
        $promos = $repo->findAll();

        /*
                * Pagination
                */
        $paginator = $this->get('knp_paginator');
        $promos_pages = $paginator->paginate(
            $promos, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            8/*limit per page*/
        );

        return $this->render('promotions/promotions.html.twig', ['promotions'=>$promos_pages]);
    }


    /**
     * AFFICHE UNE PAGE PROMOTION TODO: A CONVERTIR EN PDF
     *
     * @Route("promotion/{slug}", name="show_promo")
     */
    public function showPromo($slug){

        $doctrine = $this->getDoctrine();
        $repo = $doctrine->getRepository('App:Promotion');
        $promo = $repo->promoWithProvider($slug);

        return $this->render('promotions/promo.html.twig', ['promotion'=>$promo]);

    }
}