<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\BookRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/category', name: 'app_category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index( CategoryRepository $categoryRepository, ): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('category/index.html.twig', [
            'categories' => $categories,
            'collection_of_books' => '',

        ]);
    }
    #[Route('/{id}', name: 'collection_book')]
    public function getBooks( BookRepository $bookRepository ,Category $category, CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        $collection_of_books = $bookRepository->findBycategory($category);
        return $this->render('category/index.html.twig', [
            'collection_of_books' => $collection_of_books,
            'categories' => $categories
        ]);
    }

}
