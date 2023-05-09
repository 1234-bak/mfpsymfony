<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FirstController extends AbstractController
{   
    #[Route('/template',name: 'app_template')]
    public function template(){
        return $this->render('template.html.twig');
    }
    #[Route('order/{maVar}',name: 'app_oder')]
    public function orderToRoute($maVar){
        return new Response("
        <html>
            <body>
                $maVar
            </body>
        </html>
        ");
    }
    #[Route('/first', name: 'app_first')]
    public function index(): Response{
        return $this->render('first/index.html.twig',[
            'title' => 'New magazine',
            'content' => 'Louis vuitton is my prefer style'
        ]);
    }

    public function sayHello($name,$surname): Response{
        return $this->render('first/hello.html.twig',[
            'nom'=>$name,
            'prenom'=>$surname
            
        ]);
    
    }

    #[Route('multi/{e1<\d+>}/{e2<\d+>}',name: 'app_multi')]
    public function multiplication($e1,$e2){
        $result = $e1 * $e2;
        return new Response(
            content: "<strong>$result</strong>"
        );

    }
}
