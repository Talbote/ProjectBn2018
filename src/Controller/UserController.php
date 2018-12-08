<?php
/**
 * Created by PhpStorm.
 * User: Fab
 * Date: 3/01/18
 * Time: 16:06
 */

namespace App\Controller;

use App\Form\RegisterType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\PreRegister;
use App\Entity\Provider;
use App\Entity\Member;
use App\Form\Type;
use App\Form\ProviderType;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class UserController extends Controller
{
    /**
     *
     * formulaire temporaire
     *
     * @Route("/Pre-register", name="signup-start")
     */
    public function preSignUpMemberAction(Request $request, ObjectManager $manager)
    {

        $new_user = new PreRegister();

        $form = $this->CreateForm(RegisterType::class, $new_user);
        $form->handleRequest($request);

        if($form->isSubmitted() && ($form->isValid())) {

            $manager->persist($new_user);
            $manager->flush();
        }

        return $this->render('records/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}


