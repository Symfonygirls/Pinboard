<?php

namespace PinboardBundle\Controller;

use PinboardBundle\Manager\CardsManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

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
     *
     * @throws ServiceCircularReferenceException
     * @throws ServiceNotFoundException
     */
    public function indexAction()
    {
        $homepage_h1 = 'Welcome to Pinboard!';

        //all the logic we implemented to find the cards at first has now been moved inside a Service
        //responsible of the entire "cards" management.
        //Here is where will be put also the future Cards logic.
        $cards = $this->container->get('pinboard.cards_manager')
            ->getCards('ASC');

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
