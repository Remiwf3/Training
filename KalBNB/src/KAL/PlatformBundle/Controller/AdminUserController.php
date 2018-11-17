<?php

namespace KAL\PlatformBundle\Controller;

use KAL\PlatformBundle\Entity\User;
use KAL\PlatformBundle\Form\AdminUserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminUserController extends Controller
{
    /**
     * @Route("/admin/users/new", name="admin_user_new")
     */
    public function newAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $user = new User();
        

        $form = $this->createForm(AdminUserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            

            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "Nouvel utilisateur ajouté"
            );
        }
   

        return $this->render('@KALPlatform/admin/user/new.html.twig', array(
            'form'   =>   $form->createView()
        ));
    }

}
