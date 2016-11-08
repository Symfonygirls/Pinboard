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
}
