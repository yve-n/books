<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/product', name: 'app_product_')]
class ProductController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    #[Route('/{id}', name: 'details')]
    public function details(Request $request, Book $book, BookRepository $bookRepository ): Response
    {
        $relatedBooks = $bookRepository->findBookWithSameCategory($book->getCategory(),$book->getId());
        // $book = $bookRepository->findOneBy(['id'=> $request->get('id')]);
        return $this->render('product/details.html.twig', compact('book', 'relatedBooks'));

    }
}
