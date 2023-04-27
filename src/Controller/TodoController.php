<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\Length;

#[Route('/todo')]
class TodoController extends AbstractController
{
    #[Route('/', name: 'app_todo')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        //Afficher la liste du tableau

        //sinon ....
        if (!$session->has('todos')) {
            $todos = [
                'nom' => 'bakayoko',
                'prenom' => 'ibrahim',
                'age' => 21
            ];
            $session->set('todos',$todos);
            $this->addFlash('info',"la liste des todos viens d'être initialisée");
        }
        return $this->render('todo/index.html.twig');
        
}

    #[Route('/add/{name?cours}/{content?symfony 6}', name : 'app_add')]
    public function addTodo(Request $request,$name,$content): Response{
        $session = $request->getSession();

        if($session->has('todos')){
            $todos = $session->get('todos');

            if(isset($todos[$name])){
                $this->addFlash('error',"le todo de clé '$name' existe déja dans la liste");
            }else{
                $todos[$name] = $content;
                $this->addFlash('success',"todo ajouté avec succès");
                $session->set('todos',$todos);
            }
        }else {
            $this->addFlash('error',"la liste des todos n'est pas encore initialiée");
        }
        return $this->redirectToRoute('app_todo');
    }

    #[Route('/update/{name}/{content}', name : 'app_update')]
    public function updateTodo(Request $request,$name,$content): Response{
        $session = $request->getSession();

        if($session->has('todos')){
            $todos = $session->get('todos');

            if(!isset($todos[$name])){
                $this->addFlash('error',"la clé '$name' n'existe pas dans la liste");
            }else{
                $todos[$name] = $content;
                $this->addFlash('success',"todo modifiée avec succès");
                $session->set('todos',$todos);
            }
        }else {
            $this->addFlash('error',"la liste des todos n'est pas encore initialiée");
        }
        return $this->redirectToRoute('app_todo');
    }

    #[Route('/delete/{name}', name : 'app_delete')]
    public function deleteTodo(Request $request,$name){
        $session = $request->getSession();

        if($session->has('todos')){
            $todos = $session->get('todos');

            if(!isset($todos[$name])){
                $this->addFlash('error',"le todo de clé '$name' n'existe pas dans la liste");
            }else{
                unset($todos[$name]);
                $this->addFlash('error',"todo supprimé avec succès");
                $session->set('todos',$todos);
            }
        }else {
            $this->addFlash('error',"la liste des todos n'est pas encore initialiée");
        }
        return $this->redirectToRoute('app_todo');
    }

    #[Route('/reset', name : 'app_reset')]
    public function resetTodo(Request $request): Response{
        $session = $request->getSession();
        $session->remove('todos');
        return $this->redirectToRoute('app_todo');
    }
   
}
