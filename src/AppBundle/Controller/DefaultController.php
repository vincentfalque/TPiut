<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:default:homepage.html.twig');
    }

    /**
     * @Route("/conditions", name="conditions")
     */
    public function renderAction()
    {
        return $this->render('AppBundle:default:conditions.html.twig');
    }
}
