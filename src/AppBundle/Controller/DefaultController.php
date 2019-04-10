<?php

namespace AppBundle\Controller;

use AppBundle\Form\SearchType;
use AppBundle\Services\TwitterSearch;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{


    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request, TwitterSearch $twitterSearch)
    {

        // FORM
        $form = $this->createForm(SearchType::class);

        // initial data
        $statuses = $twitterSearch->getTweets("trump", "EN", "mixed");

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
            $statuses = $twitterSearch->getTweets(
                $data['search'],
                $data['lang'],
                $data['type']
            );

        }


        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
            'tweets' => $statuses
        ]);
    }
}
