<?php

namespace App\Controller\Admin;

use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    
    #[Route('/admin/dashboard', name: 'app_admin_dashboard')]
    public function index(BookRepository $bookRepository): Response
    {
        // $books = $this->fetchBookInformation();
        $books = $bookRepository->findAll();
        // dd($books);
        return $this->render('admin/dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'books_group' => $books
        ]);
    }

    //à implémenter plus tard
    // public function fetchBookInformation(): array
    // {
    //     $response = $this->client->request(
    //         'GET',
    //         // 'https://api.nytimes.com/svc/books/v3/lists.json?list=Trade+Fiction+Paperback&api-key='
    //         //'https://api.nytimes.com/svc/books/v3/lists/overview.json?api-key='
    //         'https://api.nytimes.com/svc/books/v3/lists/current/paperback-nonfiction.json?api-key='
    //     );
    //     $statusCode = $response->getStatusCode();
    //     $contentType = $response->getHeaders()['content-type'][0];
    //     $content = $response->getContent();
    //     $content = $response->toArray();

    //     return $content['results'];
    // }
}
