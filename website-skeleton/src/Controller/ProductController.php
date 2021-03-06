<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @var ProductRepository
     */
    private $repository;
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/products", name="product.index")
     * @return Response
     * 
     */
    public function index(): Response
    {
        $products = $this->repository->findAll();
        dump($products);
        return $this->render('product/index.html.twig', [
            'current_menu' => 'products',
            'products' => $products
        ]);
    }

    /**
     * @Route("/products/{slug}-{id}", name="product.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     *
     */
    public function show(Product $product, string $slug): Response
    {
        if ($product->getSlug() !== $slug) {
            return $this->redirectToRoute('product.show', [
                'id' => $product->getId(),
                'slug' => $product->getSlug()
            ], 301);
        }
        return $this->render('product/show.html.twig', [
            'product' => $product,
            'current_menu' => 'products'
        ]);
    }


    /**
     * @Route("/products/ordered", name="product.ordered")
     * @return Response
     *
     */
    public function showByOrder(): Response
    {
        $products = $this->repository->findOrdered();
        return $this->render('product/order.html.twig', [
            'products' => $products,
            'current_menu' => 'order'
        ]);
    }
}
