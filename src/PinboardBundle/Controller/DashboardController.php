<?php

namespace PinboardBundle\Controller;

use PinboardBundle\Entity\Card;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
        $user_cards = $this->container->get('pinboard.cards_manager')
            ->getUserCards($this->getUser());

        //Dashboard view
        return $this->render('PinboardBundle:Dashboard:index.html.twig', array(
            'user_cards' => $user_cards
        ));
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
            ->add('image', FileType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Card'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $card = $form->getData();

            //we add the current user to the card
            $card->setUser($this->getUser());

            //we upload the image
            // $file stores the uploaded PDF file
            $file = $card->getImage();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('cards_images_directory'),
                $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $card->setImage($fileName);


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

