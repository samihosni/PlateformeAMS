<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\AffectationEnseignantType;
use App\Form\AffectationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/affectationEnseignant'),IsGranted('ROLE_ADMIN')]
class AffectationEnseignantController extends AbstractController
{
    #[Route('/user', name: 'app_affectation_user')]
    public function affecterUser(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AffectationEnseignantType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // Récupérer les utilisateurs sélectionnés
            $utilisateurs = $data['utilisateurs'];

            // Récupérer la classe sélectionnée
            $cours = $data['cours'];

            // Affecter chaque utilisateur à la classe
            foreach ($utilisateurs as $utilisateur) {
                // Assurez-vous que l'utilisateur a le rôle ROLE_ENSEIGNANT
                if (in_array('ROLE_ENSEIGNANT', $utilisateur->getRoles())) {
                    $utilisateur->setCours($cours);
                }
            }

            // Enregistrer les changements
            $entityManager->persist($cours);
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            // Redirection vers une page de confirmation ou une autre page appropriée
            return $this->redirectToRoute('app_affectation_user_success');
        }

        return $this->render('affectation_enseignant/affecter_user.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/success', name: 'app_affectation_user_success')]
    public function success(): Response
    {
        return $this->render('affectation_enseignant/success.html.twig');
    }
}
