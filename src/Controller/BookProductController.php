<?php

namespace App\Controller;

use App\Entity\BookProduct;
use App\Form\BookProductType;
use App\Repository\BookProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/book/product")
 */
class BookProductController extends AbstractController
{
    /**
     * @Route("/", name="book_product_index", methods={"GET"})
     */
    public function index(BookProductRepository $bookProductRepository): Response
    {
        return $this->render('book_product/index.html.twig', [
            'book_products' => $bookProductRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="book_product_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bookProduct = new BookProduct();
        $form = $this->createForm(BookProductType::class, $bookProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bookProduct);
            $entityManager->flush();

            return $this->redirectToRoute('book_product_index');
        }

        return $this->render('book_product/new.html.twig', [
            'book_product' => $bookProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="book_product_show", methods={"GET"})
     */
    public function show(BookProduct $bookProduct): Response
    {
        return $this->render('book_product/show.html.twig', [
            'book_product' => $bookProduct,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="book_product_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, BookProduct $bookProduct): Response
    {
        $form = $this->createForm(BookProductType::class, $bookProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('book_product_index', [
                'id' => $bookProduct->getId(),
            ]);
        }

        return $this->render('book_product/edit.html.twig', [
            'book_product' => $bookProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="book_product_delete", methods={"DELETE"})
     */
    public function delete(Request $request, BookProduct $bookProduct): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bookProduct->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bookProduct);
            $entityManager->flush();
        }

        return $this->redirectToRoute('book_product_index');
    }
}
