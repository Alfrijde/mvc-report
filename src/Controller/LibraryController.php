<?php
/**
 * The LibraryController for all the library routes.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\AbstractType;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Book;
use App\Form\BookFormType;
use App\Repository\BookRepository;

class LibraryController extends AbstractController
{
    /**
     * Home page for the library.
     */
    #[Route('/library', name: 'app_library')]
    public function index(): Response
    {
        return $this->render('library/index.html.twig');
    }
    /**
     * Route for adding a book to the library.
     */
    #[Route('/library/add', name: 'library_add')]
    public function createBook(
        ManagerRegistry $doctrine,
        Request $request
    ): Response {
        $book = new Book();

        $form = $this->createForm(BookFormType::class, $book);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();


            $entityManager->persist($book);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

            return $this->redirectToRoute('library_show_all');
        }

        return $this->render('library/add.html.twig', [
            'form' => $form,
        ]);
    }
    /**
     * Route for showing all the books in the library.
     */

    #[Route('/library/show', name: 'library_show_all')]
    public function showAllBooks(
        BookRepository $bookRepository
    ): Response {
        $books = $bookRepository
            ->findAll();

        return $this->render('library/show_all.html.twig', [
            'books' => $books,
        ]);
    }
    /**
     * Shows one book by the ida in the url.
     */

    #[Route('/library/show/{id}', name: 'library_show_details')]
    public function showDetails(
        BookRepository $bookRepository,
        int $id
    ): Response {
        $book = $bookRepository
            ->find($id);

        return $this->render('library/show_details.html.twig', [
            'book' => $book,
        ]);
    }
    /**
     * Deletes a book from the library by the id in the url.
     */

    #[Route('/library/delete/{id}', name: 'delete_book')]
    public function deleteBookById(
        ManagerRegistry $doctrine,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('library_show_all');
    }
    /**
     * Updates the information on the book specified by the id in the url.
     */
    #[Route('/library/update/{id}', name: 'update_book')]
    public function updateBook(
        ManagerRegistry $doctrine,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        return $this->render('library/update.html.twig', [
            'book' => $book,
        ]);
    }
    /**
     * The updating process for the book specified by id in the url.
     */

    #[Route('/product/update_process/{id}', name: 'book_update_process', methods:['POST'])]
    public function updateBookProcess(
        ManagerRegistry $doctrine,
        Request $request,
        int $id
    ): Response {

        $name = $request->request->get('name');
        $author = $request->request->get('author');
        $isbn = $request->request->get('isbn');
        $image = $request->request->get('image');


        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $book->setName($name);
        $book->setAuthor($author);
        $book->setISBN($isbn);
        $book->setImage($image);
        $entityManager->flush();

        return $this->redirectToRoute('library_show_details', ['id' => $id]);
    }

}
