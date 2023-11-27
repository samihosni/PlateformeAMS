<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

;

class UserFixture extends Fixture implements FixtureGroupInterface
{
    public function __construct(
        private UserPasswordHasherInterface $hasher
    ) {}
    public function load(ObjectManager $manager): void
    {
        #Administrateur

        $administrateur1 =new User();
        $administrateur1->setUsername("admin1AMS");
        $administrateur1->setPassword($this->hasher->hashPassword($administrateur1,'ca1920'));
        $administrateur1->setRoles(['ROLE_ADMIN']);
        $administrateur2=new User();
        $administrateur2->setUsername("admin2AMS");
        $administrateur2->setPassword($this->hasher->hashPassword($administrateur2,'ca1920'));
        $administrateur2->setRoles(['ROLE_ADMIN']);
        $manager->persist($administrateur1);
        $manager->persist($administrateur2);

        #Enseignants

        for($i=1; $i<=4; $i++){
            $enseignant=new User();
            $enseignant->setUsername("enseignant$i");
            $enseignant->setPassword($this->hasher->hashPassword($enseignant,"ca1920$i"));
            $manager->persist($enseignant);
        }
        #Etudiants

        for($i=1; $i<=10; $i++){
            $etudiant=new User();
            $etudiant->setUsername("etudiant$i");
            $etudiant->setPassword($this->hasher->hashPassword($etudiant,"ca1920$i"));
            $manager->persist($etudiant);
        }
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ["enseignant","etudiant"];
    }
}
