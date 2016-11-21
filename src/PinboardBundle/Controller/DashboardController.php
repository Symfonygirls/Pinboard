<?php

namespace PinboardBundle\Controller;

use PinboardBundle\Entity\Card;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DashboardController
 * @package PinboardBundle\Controller
 */
class DashboardController extends Controller
{
    /**
     * Private page "Dashboard". Here we will see all the cards created by current user
     *
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboardAction()
    {
        //Dashboard view
        return $this->render('PinboardBundle:Dashboard:index.html.twig');
    }

    /**
     * Add a new card for the current user
     *
     * @Route("/add-card", name="add-card")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addCardAction(Request $request)
    {
        // just setup a fresh $task object (remove the dummy data)
        $task = new Card();

        $form = $this->createFormBuilder($task)
            ->add('title', TextType::class)
            ->add('description', TextType::class)
            ->add('image', TextType::class)
            ->add('slug', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Card'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $card = $form->getData();

            //we add the current user to the card
            $card->setUser($this->getUser());

            //we add a new card in db
             $em = $this->getDoctrine()->getManager();
             $em->persist($card);
             $em->flush();

            //we set a flash message
            $this->addFlash(
                'notice',
                'New card created!'
            );

            return $this->redirectToRoute('dashboard');
        }

        //
        return $this->render('PinboardBundle:Dashboard:new-card.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

