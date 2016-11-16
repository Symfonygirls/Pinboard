<?php

namespace PinboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

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
}

