<?php
/**
 * Created by PhpStorm.
 * User: Fab
 * Date: 3/01/18
 * Time: 16:06
 */

namespace App\Controller;

use App\Entity\Member;
use App\Form\MemberType;
use App\Entity\Provider;
use App\Entity\PreRegister;
use App\Form\ProviderType;
use App\Form\RegisterType;
use App\Services\Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserController extends AbstractController
{
    /**
     *
     * formulaire temporaire
     *
     * @Route("/pre-register", name="signup-start")
     */
    public function preSignUpAction(Request $request, EncoderFactoryInterface $encoderFactory , Mailer $mailer)
    {

        //créer un utilisateur temporaire
        $tempuser = new PreRegister();

        $form = $this->createForm(RegisterType::class, $tempuser, ['method' => 'POST']);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            //hashage du password
            $plainPassword = $tempuser->getPwd();
            $encoder = $encoderFactory->getEncoder($tempuser);
            $encoded = $encoder->encodePassword($plainPassword, '');

            $registrationdate = $tempuser->getFirstRegisterDate()->format('d-m-Y');
            $mail = $tempuser->getEmail();

            //création d'un token unique
            $token = sha1($registrationdate . $mail);

            $tempuser->setToken($token);
            $tempuser->setPwd($encoded);

            $em = $this->getDoctrine()->getManager();
            $em->persist($tempuser);
            $em->flush();

            $this->addFlash('success', 'Successful registration - confirmation email sent');

            //envoi du mail avec le service Mailer
            $subject = 'Nouvelle inscription';
            $body = $this->renderView('records/message/message_register.html.twig', array('tempuser' => $tempuser));

            $mailer->sendMessage($mail, $subject, $body);

            return $this->redirectToRoute('homepage');
        }

        return $this->render('records/register.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/register-final/{token}/{id}/{typeuser}", name="signup-final")
     * @Method({"GET", "POST"})
     */

    public function signUpFinalAction(Request $request, $token, $id)
    {

        $doctrine = $this->getDoctrine();
        $new_user = $doctrine
            ->getRepository('App:PreRegister')
            ->findOneBy(['id' => $id]);

        $type_user = $request->get('typeuser');

        if (isset($new_user) == false) {
            return $this->redirectToRoute('error_register'); //Page erreur si confirmation d'inscription no valide

        } else if ($token === $new_user->getToken()) {
            $mail = $new_user->getEMail();
            $register_date = $new_user->getFirstRegisterDate();

            if ($type_user === 'providers') {

                $user = new Provider();
                $user->setEMail($mail);
                $form = $this->createForm(ProviderType::class, $user, ['method' => 'POST']);

            } else if ($type_user === 'members') {

                $user = new Member();
                $user->setEMail($mail);
                $form = $this->createForm(MemberType::class, $user, ['method' => 'POST']);

            } else {
                return $this->redirectToRoute('error_typeUser'); //Page erreur si mauvais type d'utilisateur passé en url
            }

            $password = $new_user->getPwd();
            $user->setPassword($password);

            $form->handleRequest($request);

            if ($form->isSubmitted()) {

                if ($form->isValid()) {

                    if ($type_user === 'members') { //Les inscrits sans rôle prennent d'office ROLE_USER via entité
                        $user->setRoles(['ROLE_USER']);
                    } else {
                        $user->setRoles(['ROLE_PROVIDER']);
                    }

                    $em = $this->getDoctrine()->getManager();

                    $user->setBanned(false);
                    $user->setConfirmed(true);
                    $user->setRegistrationDate($register_date);
                    $user->setTestNo(0);



                    /*delete user temp*/
                    $em->remove($new_user);
                    $em->persist($user);
                    $em->flush();

                    /*log inscription*/
                    $mytoken = new UsernamePasswordToken(
                        $user,
                        $password,
                        'main',
                        $user->getRoles()
                    );

                    $this->get('security.token_storage')->setToken($mytoken);
                    $this->get('session')->set('_security_main', serialize($mytoken));
                    $this->addFlash('success', 'register successfull!');

                    if ($type_user === 'members') {

                        return $this->redirectToRoute('homepage', ['user' => $user->getLastName()]);

                    } else {

                        return $this->redirectToRoute('homepage', ['user' => $user->getName()]);

                    }


                }
            }
            /*Suivant type user, je dirige vers le form concerné*/
            if ($type_user === 'members') {
                return $this->render('forms/user/form_member_register.html.twig',
                    ['form' => $form->createView(), 'typeuser'=> $type_user]);
            } else {
                return $this->render('forms/user/form_provider_register.html.twig',
                    [
                    'form' => $form->createView(), 'typeuser'=> $type_user]);
            }
        }
    }
}