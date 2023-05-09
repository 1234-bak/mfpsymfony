<?php

namespace App\Controller;

use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PersonneController extends AbstractController
{
    #[Route('/personne', name: 'app_personne')]
    public function addPersonne(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $personne =  new Personne;
        $personne->setFirtname('Ibrahim');
        $personne->setName('Bakayoko');
        $personne->setAge(21);
        $personne->setJob('Ingenieur Securité avancé');
        
        $entityManager->persist($personne);
        $entityManager->flush();
        return $this->render('personne/detail.html.twig', [
            'personne'=> $personne
        ]);
    }
}
