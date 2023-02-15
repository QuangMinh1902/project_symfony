<?php


namespace App\Controller;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Entity\Article;
use App\Form\ArticleType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ArticleController extends AbstractController  
{
    /**
     * show all articles
     *
     * @param ManagerRegistry $doctrine
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/articles', name: 'app_article')]
    public function showAricles(ManagerRegistry $doctrine, PaginatorInterface $paginator, Request $request): Response
    {
        $repository = $doctrine->getRepository(Article::class);
        $articles = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt("page", 1),
            10
        );
        return $this->render('article/show_all_articles.html.twig', [
            'articles' => $articles
        ]);
    }

    #[Route('/article/delete/{id}', name: 'delete_article')]
    public function deleteArticle(Article $article, ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $entityManager->remove($article);
        $entityManager->flush();
        return $this->redirectToRoute('app_article');
    }
    
    #[Route("/article/create", name: "create_article", methods: ["GET", "POST"])]
    public function createArticle(Request $request,EntityManagerInterface $manager): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request); 
        if($form->isSubmitted() && $form->isValid() ){
            $article= $form->getData();
            $manager->persist($article);
            $manager->flush();
            $this->addFlash(
                'success',
                'New article created successfully'
            );
            return $this->redirectToRoute('app_article');
        }
        return $this->render("article/new_article.html.twig", [
            'form' => $form->createView()
        ]);
    }


}
