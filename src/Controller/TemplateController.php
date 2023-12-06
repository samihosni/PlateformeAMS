<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class TemplateController extends AbstractController
{
    #[Route('/adminON', name: 'app_template'),IsGranted('ROLE_ADMIN')]
    public function template()
    {
        return $this->render('templateAdmin.html.twig');
    }
}
