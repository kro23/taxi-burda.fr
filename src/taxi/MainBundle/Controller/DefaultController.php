<?php

namespace taxi\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('taxiMainBundle:Default:index.html.twig');
    }
}
