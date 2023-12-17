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
    #[Route('/etudiant', name: 'app_template_etudiant'),IsGranted('ROLE_ETUDIANT')]
    public function templateEt()
    {
        return $this->render('templateEtudiant.html.twig');
    }
    #[Route('/enseignant', name: 'app_template_enseignant'),IsGranted('ROLE_ENSEIGNANT')]
    public function templateEn()
    {
        return $this->render('templateEnseignant.html.twig');
    }
}
