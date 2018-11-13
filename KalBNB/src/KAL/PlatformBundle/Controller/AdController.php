<?php

namespace KAL\PlatformBundle\Controller;

use KAL\PlatformBundle\Entity\Ad;
use KAL\PlatformBundle\Form\AnnonceType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use KAL\PlatformBundle\Repository\AdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class AdController extends Controller
{

    /**
     * Permet d'afficher la page d'index des annonces
     * 
     * @Route("/ads", name="ads_index")
     *
     * @return Response
     */
    public function indexAction(){

        $repo = $this->getDoctrine()->getRepository(Ad::class);

        $ads = $repo->findAll();

        return $this->render('@KALPlatform/ad/index.html.twig', [
            'ads'    =>    $ads
        ]);

    }

    /**
     * Permet de créer une annonce
     * 
     * @Route("/ads/new", name="ads_create")
     *
     * @return Response
     */
    public function createAction(Request $request){
        $ad = new Ad();

        $form = $this->createForm(AnnonceType::class, $ad);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager = $this->getDoctrine()->getManager();

            $manager->persist($ad);
            $manager->flush();


            return $this->redirectToRoute('ads_show', [
                'slug'    =>    $ad->getSlug()
            ]);

        }

        return $this->render('@KALPlatform/ad/new.html.twig', [
            'form'   =>    $form->createView()
        ]);
    }

    /**
     * Permet d'afficher une seule annonce
     *
     * @Route("/ads/{slug}", name="ads_show")
     * 
     * @return Response
     */
    public function showAction($slug){
        $repo = $this->getDoctrine()->getRepository(Ad::class);

        $ad = $repo->findOneBySlug($slug);

        return $this->render('@KALPlatform/ad/show.html.twig', [
            'ad'        =>       $ad
        ]);
    }



}