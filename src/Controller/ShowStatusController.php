<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;

class ShowStatusController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->redirectToRoute('show_status');
    }

    /**
     * @Route("/show/status", name="show_status")
     */
    public function index(): Response
    {

        $client = HttpClient::create();
        $response = $client->request('GET', 'http://127.0.0.1:8008/status/15848432139');

        // the template path is the relative file path from `templates/`
        return $this->render('status/show.status.html.twig', [
            // this array defines the variables passed to the template,
            // where the key is the variable name and the value is the variable value
            // (Twig recommends using snake_case variable names: 'foo_bar' instead of 'fooBar')
            'state' => $response->toArray()['message'],
        ]);
    }
}
