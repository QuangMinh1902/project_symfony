<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 22; $i++) {
            $article = new Article();
            $article->setName("Nike"  . "75$i");
            $article->setPrix(rand(100, 400));
            $article->setDescription("This is a Nike pair with the number 75$i");
            $article->setNombresAvailable($i + rand(1, 30));
            $article->setCreateAt(new \DateTimeImmutable());

            $manager->persist($article);
        }

        $manager->flush();
    }
}
