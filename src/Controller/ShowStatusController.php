<?php

namespace App\Controller;

use App\Form\StatusType;
use App\Form\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/show/status/{number}", name="show_status")
     */
    public function index(string $number): Response
    {

        $client = HttpClient::create();
        $response = $client->request('GET', 'http://127.0.0.1:8008/status/'.$number);


        // the template path is the relative file path from `templates/`
        return $this->render('status/show.status.html.twig', [
            // this array defines the variables passed to the template,
            // where the key is the variable name and the value is the variable value
            // (Twig recommends using snake_case variable names: 'foo_bar' instead of 'fooBar')
            'state' => $response->toArray()['message'],
        ]);
    }

    /**
     * @Route("/insert_number", name="number")
     */
    public function index2(Request $request): Response
    {

        $form = $this->createForm(SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() ) {
            return $this->redirect('http://127.0.0.1:8000/show/status/NW22032020173920MCTGPH');
        }

        // the template path is the relative file path from `templates/`
        return $this->render('number.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
