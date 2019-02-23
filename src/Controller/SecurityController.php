<?php
/**
 * Created by PhpStorm.
 * User: Fab
 * Date: 2/01/18
 * Time: 12:20
 */

namespace App\Controller;

use App\Services\Persist;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\ChangePassword;
use App\Form\ChangePasswordType;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use App\Services\EmailPassword;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {


        $authenticationUtils = $this->get('security.authentication_utils');


        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig',
            array(
                'last_username' => $lastUsername,
                'error' => $error,
            ));

    }

    /**
     * erreur password
     * @Route("/forgot_password", name="forgot_password")
     */
    public function forgotAction()
    {
        $this->addFlash('notice', 'error password');
        return $this->redirectToRoute('login');

        /* TODO reset password */
    }


    /**
     * Changement du mot de passe
     * @Route("/change_password", name="change_password")
     */
    public function changePasswordAction(Request $request,Persist $persist ) {

        $new_pwd = new ChangePassword();

        $form = $this->createForm(ChangePasswordType::class, $new_pwd, ['method' => 'POST']);
        $form->handleRequest($request);

        $error = '';


        if ($new_pwd->getNewPassword() === $new_pwd->getConfNewPassword() && $new_pwd->getNewPassword() !== null) {

            if ($form->isValid()) {
                if ($form->isSubmitted()) {
                    $user = $this->getUser();
                    $plainPassword = $new_pwd->getNewPassword();
                    $encoder = $this->container->get('security.password_encoder');
                    $encoded = $encoder->encodePassword($user, $plainPassword);

                    $user->setPassword($encoded);

                    $persist->persist($user);

                    $emailValid = $this->get('App\Services\EmailPassword');
                    $emailValid->sendMailConfirm($user);

                    $this->addFlash('success', 'password update');

                    return $this->redirectToRoute('logout');
                }
            }
        } elseif ($new_pwd->getPassword() === null) {
            $error = '';
        } else {
            $error = 'has-error'; /*applique class*/
        }

        /*Definie la route vers formulaire suivant le role*/
        $route=($this->get('security.authorization_checker')->isGranted('ROLE_PROVIDER'))?'security/change_password_Provider.html.twig':'security/change_password.html.twig';

        return $this->render($route, ['form' => $form->createView(), 'error' => $error]);
    }

}