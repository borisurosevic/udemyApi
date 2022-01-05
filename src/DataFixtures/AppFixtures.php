<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $blogPost = new BlogPost();
        $blogPost->setTitle('A first post!');
        $blogPost->setPublished(new \DateTime('2018-07-01 12:00:00'));
        $blogPost->setContent('Post text!');
        $blogPost->setAuthor('Boris');
        $blogPost->setSlug('a-first-post');

        $manager->persist($blogPost);

        $blogPost = new BlogPost();
        $blogPost->setTitle('A second post!');
        $blogPost->setPublished(new \DateTime('2018-07-05 06:14:40'));
        $blogPost->setContent('Post text second!');
        $blogPost->setAuthor('Bora');
        $blogPost->setSlug('a-second-post');

        $manager->persist($blogPost);

        $blogPost = new BlogPost();
        $blogPost->setTitle('A third post!');
        $blogPost->setPublished(new \DateTime('2018-07-06 15:18:03'));
        $blogPost->setContent('Post text third!');
        $blogPost->setAuthor('Boris');
        $blogPost->setSlug('a-third-post');

        $manager->persist($blogPost);

        $manager->flush();
    }
}
