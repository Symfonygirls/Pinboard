<?php

namespace PinboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FrontendController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $homepage_h1 = 'Welcome to Pinboard!';

        return $this->render('PinboardBundle:Frontend:index.html.twig', array(
            'homepage_h1' => $homepage_h1
        ));
    }

    /**
     * @Route("/info", name="info")
     */
    public function infoAction()
    {
        $info_h1 = 'This is the info page';

        return $this->render('PinboardBundle:Frontend:info.html.twig', array(
            'info_h1' => $info_h1
        ));
    }
}
