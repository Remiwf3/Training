<?php

namespace KAL\PlatformBundle\Controller;

use KAL\PlatformBundle\Entity\Ad;
use KAL\PlatformBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homeAction()
    {
        $repoAd = $this->getDoctrine()->getRepository(Ad::class);
        $repoUser =$this->getDoctrine()->getRepository(User::class);

        return $this->render('@KALPlatform/Home/home.html.twig', [
            'ads'    =>   $repoAd->getBestAds(3),
            'users'  =>   $repoUser->getBestProprio(2)
        ]);
    }
}
