<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    #[Route('/cnp-form', name: 'cnp_form')]
    public function cnpForm(): Response
    {
        return $this->render('cnp_form.html.twig');
    }
}
