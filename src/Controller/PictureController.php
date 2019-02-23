<?php

namespace App\Controller;

use App\Services\Persist;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Entity\Provider;
use App\Entity\Member;
use App\Entity\User;
use App\Entity\Image;
use App\Form\ImageType;

class PictureController extends Controller
{
    /**
     * @Route("/provider/gallery", name="gallery_provider")
     * @Method({"GET"})
     */
    public function galleryProviderAction(Request $request)
    {
        $user = $this->getUser();

        return $this->render('Provider/gallery.html.twig',[
            'user' => $user,
        ]);
    }

    /**
     * @Route("/provider/image/{type}", name="image_provider")
     * @Method({"GET", "POST"})
     */
    public function imageProviderAction(Request $request, Persist $persist, $type = null)
    {

        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $provider = $this->getUser();
            $id = $provider->getId();

            //logo ou  photo  galerie

            if ($type == 'logo' && $provider->getLogo()) {
                $img = $provider->getLogo();
            } elseif ($type == 'gallery' && $provider->getGallery()) {
                $img = $provider->getGallery();
            } else {
                $img = new Image();
            }

            $form_image = $this->createForm(ImageType::class, $img, ['method' => 'POST']);
            $form_image->handleRequest($request);

            if ($form_image->isSubmitted() && $form_image->isValid()) {

                //recupere du fichier
                $file = $img->getImage();
                //genere un nom unique
                $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                //deplace dans un repertoire cible
                $file->move(
                    $this->getParameter('brochures_directory'),
                    $fileName
                );

                $img->setImage($fileName);
                ($type == 'logo') ? $provider->setLogo($img) : $img -> setProviderImage($id);
                $persist->persist($img);
                $this->addFlash('success', 'Image saved');
                return $this->redirectToRoute('edit_profil');

            }
        }
        return $this->render('forms/user/form_user_image.html.twig',[
            'form_image' => $form_image->createView(),
            'type' => $type,
            'image' => $img,
            'user' => $provider,

        ]);
    }

    /**
     * @Route("/member/image/avatar", name="image_member")
     * @Method({"GET", "POST"})
     */
    public function avatarInternaueAction(Request $request, Persist $persist)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {

            $user = $this->getUser();
            $image = new Image();

            $form_image = $this->createForm(ImageType::class, $image, ['method' => 'POST']);
            $form_image->handleRequest($request);

            if ($form_image->isSubmitted() && $form_image->isValid()) {
                //recupertation du fichier
                $file = $image->getImage();
                //genere un nom unique
                $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                //deplace dans un repertoire cible
                $file->move(
                    $this->getParameter('brochures_directory'),
                    $fileName
                );
                /*probleme au niveau de persist*/
                $image->setImage('../../uploads/brochures/'.$fileName);

                $user->setAvatar($image);

                $persist->persist($image);

                $this->addFlash('success', 'Image saved');
                return $this->redirectToRoute('edit_profil');

            }

            return $this->render('forms/user/form_user_image.html.twig', [
                'form_image' => $form_image->createView(),
                'image' => $image,
                'user' => $user,

            ]);
        }
    }
    private function generateUniqueFileName()
    {
        $prefix = "img_";
        return md5(uniqid($prefix));
    }
}
