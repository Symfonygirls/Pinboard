<?php
namespace PinboardBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PinboardBundle\Entity\Card;

class LoadCardBundle implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $card1 = new Card();
        $card1->setTitle('Card 1');
        $card1->setDescription('Card 1 description');
        $card1->setImage('https://source.unsplash.com/random/300x200');
        $card1->setSlug('card-1');

        $manager->persist($card1);

        $card2 = new Card();
        $card2->setTitle('Card 2');
        $card2->setDescription('Card 2 description');
        $card2->setImage('https://source.unsplash.com/random/300x200');
        $card2->setSlug('card-2');

        $manager->persist($card2);

        $card3 = new Card();
        $card3->setTitle('Card 3');
        $card3->setDescription('Card 3 description');
        $card3->setImage('https://source.unsplash.com/random/300x200');
        $card3->setSlug('card-3');

        $manager->persist($card3);

        $card4 = new Card();
        $card4->setTitle('Card 4');
        $card4->setDescription('Card 4 description');
        $card4->setImage('https://source.unsplash.com/random/300x200');
        $card4->setSlug('card-4');

        $manager->persist($card4);

        $manager->flush();
    }
}