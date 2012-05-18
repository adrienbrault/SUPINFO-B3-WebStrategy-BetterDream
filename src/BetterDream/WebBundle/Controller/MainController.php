<?php

namespace BetterDream\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

/**
 * MainController
 *
 * @author Adrien Brault <adrien.brault@gmail.com>
 */
class MainController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/about")
     * @Template()
     */
    public function aboutAction()
    {
        return array();
    }

    /**
     * @Route("/help")
     * @Template()
     */
    public function helpAction()
    {
        return array();
    }

    /**
     * @Route("/contact")
     * @Template()
     */
    public function contactAction()
    {
        return array();
    }

    /**
     * @Route("/how-to-have-better-dreams")
     * @Template()
     */
    public function howToAction()
    {
        return array();
    }
}
