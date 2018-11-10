<?php
/**
 * Created by PhpStorm.
 * User: odolinski
 * Date: 04/11/2018
 * Time: 14:16
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ErrorController extends Controller
{
    /**
     * @Route("error_register",name="error_register")
     */
    public function ErreurNoUserAction()
    {
        $php_errormsg = ['msg'=>'register\'not valid'];
        return $this->render('Exception/user_record.html.twig', ['error' => $php_errormsg]);
    }

    /**
     * @Route("/error_typeuser",name="error_typeuser")
     */
    public function ErreurTypeUserAction()
    {
        $php_errormsg = ['msg'=>'Type \'user not valid'];
        return $this->render('Exception/user_record.html.twig', ['error' => $php_errormsg]);
    }

    // ERREUR CATEGORIE DE SERVICES

    /**
     * @Route("error_service_notfound",name="error_service_notfound")
     */
    public function ErreurSerIntrAction()
    {
        $php_errormsg = ['msg' => 'List service not found'];
        return $this->render('Exception/categorie_error.html.twig', ['error' => $php_errormsg]);
    }

    /**
     * @Route("error_service_notvalid",name="error_service_notvalid")
     */
    public function ErreurSerNoValideAction()
    {
        $php_errormsg = ['msg'=>'service not valid'];
        return $this->render('Exception/categorie_error.html.twig', ['error' => $php_errormsg]);
    }

    /**
     * @Route("error_liste_services",name="error_list_services")
     */
    public function ErreurSerNoListAction()
    {
        $php_errormsg = ['msg'=>' Services arent valid'];
        return $this->render('Exception/categorie_error.html.twig', ['error' => $php_errormsg]);
    }

    // ERREUR PRESTATAIRES

    /**
     * @Route("error_liste_prestataires",name="error_liste_prestataires")
     */
    public function ErreurPrestNoListAction()
    {
        $php_errormsg = ['msg'=>'Aucuns prestataires validées'];
        return $this->render('Exception/prestataire_error.html.twig', ['error' => $php_errormsg]);
    }

    /**
     * @Route("error_detail_prestataires",name="error_detail_prestataires")
     */
    public function ErreurPrestNoDetailAction()
    {
        $php_errormsg = ['msg'=>'Détail du prestataire introuvable'];
        return $this->render('Exception/prestataire_error.html.twig', ['error' => $php_errormsg]);
    }

    // ERREUR TYPE GENERAL

    /**
     * @Route("error_interne",name="error_interne")
     */
    public function ErreurAction()
    {
        $php_errormsg = ['msg'=>'Erreur Interne'];
        return $this->render('Exception/error.html.twig', ['error' => $php_errormsg]);
    }

    /**
     * @Route("/error_banni",name="error_banni")
     */
    public function ErreurBanniAction()
    {
        $php_errormsg = ['msg'=>'Vous êtes Banni !'];
        return $this->render('Exception/error.html.twig', ['error' => $php_errormsg]);
    }
}