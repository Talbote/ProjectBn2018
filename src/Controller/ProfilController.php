<?php

namespace App\Controller;

use App\Services\Persist;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Form\MemberType;
use App\Form\ProviderType;
use App\Entity\Service;
use App\Form\ServiceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ProfilController extends AbstractController
{
    /**
     * Gestion du profil user
     * @Route("/user/edit_profil", name="edit_profil")
     * @Method({"GET", "POST"})
     */
    public function updateUser(Request $request, Persist $persist)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->getUser();
            $id = $user->getId();

        } else {
            return $this->redirectToRoute('error_typeUser'); //Page erreur si mauvais rôle
        }

        if ($this->get('security.authorization_checker')->isGranted('ROLE_PROVIDER'))
        {
            $form = $this->createForm(ProviderType::class, $user, ['method' => 'POST']);
        } else {
            $form = $this->createForm(MemberType::class, $user, ['method' => 'POST']);
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($persist-> persist($user)){

                $this->addFlash('success', 'profil updated');
            }else{
                $this->addFlash('error', 'error while updating profile');
            }


            return $this->redirectToRoute('edit_profil');
        }

        if ($this->get('security.authorization_checker')->isGranted('ROLE_PROVIDER'))
        {
            return $this->render('providers/profil_edit.html.twig', [
                'providerForm' => $form->createView(), 'id' => $id, 'user'=>$user]);
        } else {
            return $this->render('members/profil_edit.html.twig', [
                'memberForm' => $form->createView(), 'id' => $id, 'user'=>$user]);
        }

    }

}
