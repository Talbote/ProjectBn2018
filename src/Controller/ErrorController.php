<?php
/**
 * Created by PhpStorm.
 * User: odolinski
 * Date: 04/11/2018
 * Time: 14:16
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ErrorController extends AbstractController
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

    // ERROR SERVICES

    /**
     * @Route("error_service_notfound",name="error_service_notfound")
     */
    public function ErreurSerIntrAction()
    {
        $php_errormsg = ['msg' => 'List service not found'];
        return $this->render('Exception/categories_error.html.twig', ['error' => $php_errormsg]);
    }

    /**
     * @Route("error_service_notvalid",name="error_service_notvalid")
     */
    public function ErrorSerNoValideAction()
    {
        $php_errormsg = ['msg'=>'service not valid'];
        return $this->render('Exception/category_error.html.twig', ['error' => $php_errormsg]);
    }

    /**
     * @Route("error_liste_services",name="error_list_services")
     */
    public function ErrorSerNoListAction()
    {
        $php_errormsg = ['msg'=>' Services arent valid'];
        return $this->render('Exception/categories_error.html.twig', ['error' => $php_errormsg]);
    }

    // ERREUR PROVIDERS

    /**
     * @Route("error_lists_providers",name="error_list_providers")
     */
    public function ErrorProvidersNoListAction()
    {
        $php_errormsg = ['msg'=>'no providers valid'];
        return $this->render('Exception/providers_error.html.twig', ['error' => $php_errormsg]);
    }

    /**
     * @Route("error_detail_providers",name="error_detail_providers")
     */
    public function ErrorProviderNoDetailAction()
    {
        $php_errormsg = ['msg'=>'provider no found '];
        return $this->render('Exception/provider_error.html.twig', ['error' => $php_errormsg]);
    }

    // ERROR TYPE GENERAL

    /**
     * @Route("error_internt",name="error_internet")
     */
    public function ErreurAction()
    {
        $php_errormsg = ['msg'=>'Error Interne'];
        return $this->render('Exception/error.html.twig', ['error' => $php_errormsg]);
    }

    /**
     * @Route("/error_ban",name="error_ban")
     */
    public function ErreurBanniAction()
    {
        $php_errormsg = ['msg'=>'you are banned !'];
        return $this->render('Exception/error.html.twig', ['error' => $php_errormsg]);
    }
}