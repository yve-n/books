<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/product', name: 'app_admin_product_')]
class ProductController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(BookRepository $bookRepository): Response
    {
        $books = $bookRepository->findAll();
        return $this->render('admin/product/index.html.twig', [
            'books' => $books
        ]);
    }

    #[Route('/add', name: 'add')]
    public function addProduct(Request $request , EntityManagerInterface $entityManager){

        $book= new Book;
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $files = $form->get('images')->getData();

            if($files){
                foreach ($files as $file) {
                    $directory = $this->getParameter('images_directory');
                    $fileName = md5(uniqid().'.'.$file->guessExtension());
                    $file->move($directory,$fileName);
                    $book->setImage($fileName);
                }
            }
            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_product_index');
        }
        return $this->render('admin/product/manage/add.html.twig', [
            'addForm' => $form->createView(),
        ]);
    }

    #[Route('/edit/{id}', name: 'edit')]
    public function editProduct(Request $request ,  BookRepository $bookRepository,EntityManagerInterface $entityManager ){
        $book = $bookRepository->findOneBy(['id' => $request->get('id')]);
        
        if($book){
            $formEdit = $this->createForm(BookType::class, $book);
            $formEdit->handleRequest($request);   
            if($formEdit->isSubmitted() && $formEdit->isValid()){
                $entityManager->persist($formEdit->getData());
                $entityManager->flush();
                return $this->redirectToRoute('app_admin_product_index');
            } 
        }else{
            return $this->redirectToRoute('app_admin_dashboard');
        }

        return $this->render('admin/product/manage/edit.html.twig',[
            'formEdit' => $formEdit->createView()
        ]);

    }

    #[Route('/delete/{id}', name: 'delete')]
    public function deleteProduct(Request $request ,  BookRepository $bookRepository, ManagerRegistry $doctrine){

        $book = $bookRepository->findOneBy(['id' => $request->get('id')]);
        if($book){
            $em = $doctrine->getManager();
            $bookRepository->remove($book);
            $em->flush();
            return $this->redirectToRoute('app_admin_product_index');
        }
    }
}
