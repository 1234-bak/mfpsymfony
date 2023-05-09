<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TabController extends AbstractController
{
    #[Route('/tab/{nb<\d+>?5}', name: 'app_tab')]
    public function index($nb): Response{
        $notes = [];
        for ($i=0; $i < $nb; $i++) { 
            $notes[$i] = rand(0,20);
        }
        $moy = array_sum($notes) / $nb;
        return $this->render('tab/index.html.twig', [
            'notes' => $notes,
            'moyenne' => $moy
        ]);
    }

    #[Route('tab/users', name: 'app_users')]
    public function afficher(){
        $users = [
            ['name'=>'Bakayoko','surname'=>'Ibrahim','age'=>21],
            ['name'=>'Soro','surname'=>'Yele','age'=>19],
            ['name'=>'Ole','surname'=>'Emeric','age'=>21]
        ];
        return $this->render('tab/afficher.html.twig',[
            'users'=>$users
        ]);
    }
}
