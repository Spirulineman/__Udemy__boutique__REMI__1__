<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
/* use App\Form\SearchType; */

class ProductController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/nos-produits', name: 'products')]
    public function index(): Response
    {
         $products = $this->entityManager->getRepository(Product::class)->findAll();

         $search = new Search();
         $form = $this->createForm(SearchType::class, $search);

        /* dd($products); */
        return $this->render('product/index.html.twig', [
            'products'=> $products,
            'form' => $form->createView()
        ]);
    }

    #[Route('/produit/{slug}', name: 'product')]
    public function show($slug): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->findOneBy(['Slug'=> $slug]);/*['Slug'=> $slug] La clé Slug fait référence à la classe Product avec la variable private $Slug; de l'entité Product  */

        if (!$product) {
            return $this->redirectToRoute('products');
        }

        /* dd($product); */
        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }
}
