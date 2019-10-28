<?php

namespace App\Controller;

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
            'current_menu' => 'products'
        ]);
    }
}
