<?php

namespace App\Controller;

use App\Entity\Provider;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;



class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {


        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            /*
             * Vérifie si l'inscription est confirmé
             */
            if ($this->getUser()->getConfirmed() == false) {
                $this->addFlash('error', 'Compte non validé !');
                return $this->redirectToRoute('logout');
                /*
                 * Vérifie si le compte n'est pas banni
                 */
            } else if ($this->getUser()->getBanned() == true) {
                $this->addFlash('error', 'Vous êtes banni !');
                return $this->redirectToRoute('logout');
            }
        }


        $doctrine = $this->getDoctrine();
        $repo_providers = $doctrine->getRepository('App:Provider');
        $repo_services = $doctrine->getRepository('App:Service');

        $providers = $repo_providers->findProvidersWithLogo(); //affiche 8 providers avec logo
        $services = $repo_services->findAll();

        return $this->render('home/home.html.twig', ['providers'=>$providers, 'services'=>$services]);
    }
}
