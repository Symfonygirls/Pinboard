<?php

namespace PinboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class FrontendController
 * @package PinboardBundle\Controller
 */
class FrontendController extends Controller
{
    /**
     * The main page of Pinboard!
     *
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
     * "Static" info page
     *
     * @Route("/info", name="info")
     */
    public function infoAction()
    {
        $info_h1 = 'This is the info page';

        return $this->render('PinboardBundle:Frontend:info.html.twig', array(
            'info_h1' => $info_h1
        ));
    }

    /**
     * Page for a single card
     *
     * @Route("/card/{name}", name="card")
     *
     * @param $name
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function cardAction($name)
    {
        return $this->render('PinboardBundle:Frontend:card.html.twig', array(
            'card_name' => $name
        ));
    }
}
