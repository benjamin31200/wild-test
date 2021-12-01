<?php
// src/Controller/CategoryController.php
namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Entity\Program;
use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/category", name="category_")
*/
class CategoryController extends AbstractController
{
    /**
     * @Route("/{name}", name="index")
     */
    public function index(string $name)
    {
        $category = $this->getDoctrine()
        ->getRepository(Category::class)
        ->findAll(['name' => $name]);

        if (!$category) {
            throw $this->createNotFoundException(
                'No category with name : '.$name.' found in categorie\'s table.'
            );
        } 
        return $this->render('category/index.html.twig', ['names' => $name]);
        
    }
    

    /**
     * @Route("/show/{name}", name="show")
     */
    public function show( string $name)
    {
        
        /** @var CategoryRepository */
        $repository = $this->getDoctrine()
        ->getRepository(Program::class);
        $category = $repository->findByCategoryName();

        $categoryName = $this->getDoctrine()
        ->getRepository(Category::class)
        ->findAll(['name' => $name]);
         
        
        if (!$category) {
            throw $this->createNotFoundException(
                'No series found with name : '.$name.' found in program\'s table.'
            );
        }
        return $this->render('category/show.html.twig', ['categories' => $category, 'name' => $name]);
    }
}