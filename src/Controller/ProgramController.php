<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    // #[Route('/program/{id<\d+>}', name: 'program_index')]
    public function index(): Response
    {
        return $this->render('program/index.html.twig', [
            'website' => 'Wild Series',
        ]);
    }


    #[Route('/user/{id<\d+>}', methods: ['GET'], name: 'user')]
    public function show(int $id): Response
    {
        $user = "";

        if ($id === 1) {
            $user = "Ludo";
        } else {
            $user = "Xalyl";
        }

        // curl -I -X POST "http://localhost:8000/program/user/1"
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (is_numeric($id)) {
                return $this->render('program/index.html.twig', [
                    'user' => $user,
                ]);
            } 
        }
    }
}
