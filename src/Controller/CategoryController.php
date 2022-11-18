<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    //Method INDEX
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categorys = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', ['categorys' => $categorys]);
    }

    
    //Method SHOW
    #[Route('/{categoryName}', methods: ['GET'], name: 'show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
    {
        $category = $categoryRepository->findOneBy(['name' => $categoryName]);

        if (!$category) {
            throw $this->createNotFoundException(
                'No category with id : ' . $categoryName . ' found in category\'s table.'
            );
        }
        else{
            $programs = $programRepository->findBy(['category' => $category->getId()], ['id' => 'DESC'], 7);
        }
        return $this->render('category/show.html.twig', [
            'category' => $category,
            'programs' => $programs
        ]);
    }
}
