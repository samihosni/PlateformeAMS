<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\AffectationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/affectation'),IsGranted('ROLE_ADMIN')]
class AffectationController extends AbstractController
{
    #[Route('/user', name: 'app_affectation_userr')]
    public function affecterUser(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AffectationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // Récupérer les utilisateurs sélectionnés
            $utilisateurs = $data['utilisateurs'];

            // Récupérer la classe sélectionnée
            $classe = $data['classe'];

            // Affecter chaque utilisateur à la classe
            foreach ($utilisateurs as $utilisateur) {
                // Assurez-vous que l'utilisateur a le rôle ROLE_ETUDIANT
                if (in_array('ROLE_ETUDIANT', $utilisateur->getRoles())) {
                    $utilisateur->addClasse($classe);
                }
            }

            // Enregistrer les changements
            $entityManager->persist($classe);
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            // Redirection vers une page de confirmation ou une autre page appropriée
            return $this->redirectToRoute('app_affectation_user_success');
        }

        return $this->render('affectation/affecter_user.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/success', name: 'app_affectation_user_successs')]
    public function success(): Response
    {
        return $this->render('affectation/success.html.twig');
    }
}
