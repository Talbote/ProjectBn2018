<?php
/**
 * Created by PhpStorm.
 * User: Fab
 * Date: 3/01/18
 * Time: 16:06
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\PreRegister;
use App\Entity\Provider;
use App\Entity\Member;
use App\Form\RegisterType;
use App\Form\Type;
use App\Form\ProviderType;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class UserController extends Controller
{

    /**
     * @Route("/Pre-register", name="user_register")
     */
    public function preSignUpMemberAction(Request $request, EncoderFactoryInterface $encoderFactory)
    {

$new_user = new PreRegister();

        $form = $this->CreateForm(RegisterType::class, $new_user, ['method' => 'POST'] );
        $form->handleRequest($request);

        $doctrine = $this->getDoctrine();
        $email = $new_user->GetEmail();



        $user_exist = $doctrine ->getRepository('App:User')->findBy(['eMail' => $email]);


if($user_exist){
    $this->addFlash('notice','Email already exist');
    return $this->redirectToRoute('user_register');
};

        if ($form->isSubmitted() && ($form->isValid())) {

            $password = $new_user->getPassword();
            $crypt = $encoderFactory->getEncoder($new_user);
            $crypter = $crypt->encodePassword($password, '');


            $new_user->setToken();
            $new_user->setPassword($crypter);

            $this->get('App\Services\Persist') -> persist($new_user);

            $emailValid = $this->get('App\Services\EmailRegister');
            $emailValid->sendMailConfirm($new_user);

            $this->addFlash('success', 'full registration');

            return $this->redirectToRoute('homepage');

        }


        return $this->render('records/register.html.twig', [
            'form' => $form->createView()
        ]);
    }



}
