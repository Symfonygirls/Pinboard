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

        //let's add an array of cards stub. This will be changed and changed into a real thing later.
        //generateUrl is a method implemented from UrlGeneratorInterface which uses the "router" Service
        //with generateUrl we let Symfony create for us the url by a given route and its parameters ( In our case "name" )
        $cards = [
          'card_1' => [
              'title' => 'Card 1',
              'description' => 'This is card 1',
              'url' => $this->generateUrl('card', [
                  'name' => 'card-1'
                  ]
              )
          ],
          'card_2' => [
              'title' => 'Card 2',
              'description' => 'This is card 2',
              'url' => $this->generateUrl('card', [
                      'name' => 'card-2'
                  ]
              )
          ],
          'card_3' => [
              'title' => 'Card 3',
              'description' => 'This is card 3',
              'url' => $this->generateUrl('card', [
                      'name' => 'card-3'
                  ]
              )
          ]
        ];

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
