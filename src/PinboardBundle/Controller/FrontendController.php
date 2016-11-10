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

        //We now call the Card Repository class and "findAll" the Cards saved in database
        //The route will be now built directly in the database, calling the Symfony Twig function "url"
        $cards_repository = $this->getDoctrine()
            ->getRepository('PinboardBundle:Card');

        $cards = $cards_repository->findAll();

        return $this->render('PinboardBundle:Frontend:index.html.twig', array(
            'homepage_h1' => $homepage_h1,
            'cards' => $cards
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
     * @Route("/card/{slug}", name="card")
     *
     * @param $slug
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function cardAction($slug)
    {
        $cards_repository = $this->getDoctrine()
            ->getRepository('PinboardBundle:Card');

        //the slug is a unique field in our database, so we use it to grab the card
        $card = $cards_repository->findOneBy(array(
            'slug' =>  $slug
        ));

        //we need to change the variable. Now we pass the entire Card entity
        return $this->render('PinboardBundle:Frontend:card.html.twig', array(
            'card' => $card
        ));
    }
}
