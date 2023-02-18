<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $brands = ["Nike", "Adidas", "Puma", "New Balance", "Vans", "Converse"];
        $categories = [];
        foreach ($brands as $brand) {
            $category = new Category();
            $category->setName($brand);
            $manager->persist($category);
            $categories[] = $category;
        }

        for ($i = 0; $i < 60; $i++) {
            $article = new Article();
            $article->setName("Chaussures "  . rand(157534, 999999999));
            $article->setPrice(rand(100, 700));
            $article->setDescription("Notre chaussures sont en stock!");
            $article->setNombresAvailable($i + rand(1, 50));
            $article->setCreateAt(new \DateTimeImmutable());
            $article->setCategory($categories[rand(0, count($categories) - 1)]);
            $manager->persist($article);
        }

        $manager->flush();
    }
}
