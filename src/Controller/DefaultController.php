<?php

namespace App\Controller;

use App\Entity\Provider;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {

        $doctrine = $this->getDoctrine();
        $repo_providers = $doctrine->getRepository('App:Provider');
        $repo_services = $doctrine->getRepository('App:Service');

        $providers = $repo_providers->findProvidersWithLogo(); //affiche 8 providers avec logo
        $services = $repo_services->findAll();

        return $this->render('home/home.html.twig', ['providers'=>$providers, 'services'=>$services]);
    }
}
