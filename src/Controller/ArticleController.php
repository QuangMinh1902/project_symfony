<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'app_article')]
    public function showAricles(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Article::class);
        $articles = $repository->findAll();

        return $this->render('article/show_all_articles.html.twig', [
            'articles' => $articles,
        ]);
    }
}
