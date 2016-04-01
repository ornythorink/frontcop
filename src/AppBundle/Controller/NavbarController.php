<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;


class NavbarController extends Controller
{
    public function indexAction(Request $request)
    {

        //$rootCategories = $categoriesRepository->findRootCategories();
        $client = new Client();
        $response = $client->get('http://127.0.0.1:8000/api/root/categories');
        $rootCategories = json_decode($response->getBody()->getContents() ,true );

        \Doctrine\Common\Util\Debug::dump($rootCategories);


        $categories = array();
        $form = $this->createFormBuilder()
            ->add('query', 'text', array(
                    'attr' => array(
                        'placeholder' => 'Rechercher ...',
                        'class' => 'form-control',
                    ))
            )->getForm();

        return $this->render('AppBundle:Default:navbar.html.twig',
            array(
                'categories' => $categories,
                'form'       => $form->createView()
            )
        );
    }
}
