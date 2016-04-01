<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $array = array();
        $adapter = new ArrayAdapter($array);
        $pagerfanta = new Pagerfanta($adapter);

        $pagerfanta->setMaxPerPage(10); // 10 by default
        $maxPerPage = $pagerfanta->getMaxPerPage();

        $pagerfanta->setCurrentPage(1); // 1 by default
        $currentPage = $pagerfanta->getCurrentPage();

        $nbResults = $pagerfanta->getNbResults();
        $currentPageResults = $pagerfanta->getCurrentPageResults();

        $pagerfanta->getNbPages();

        $pagerfanta->haveToPaginate(); // whether the number of results if higher than the max per page

        /*
        $pagerfanta->hasPreviousPage();
        $pagerfanta->getPreviousPage();
        $pagerfanta->hasNextPage();
        $pagerfanta->getNextPage();*/



        // replace this example code with whatever you need
        return $this->render('AppBundle:Default:index.html.twig',
            array(
                'items'       => array(),
                'brandFilter' => array(),
                'priceFilter' => array(),
                'pagination' => $pagerfanta,
            )
        );
    }
}
