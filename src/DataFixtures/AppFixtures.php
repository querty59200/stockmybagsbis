<?php

namespace App\DataFixtures;

use App\Entity\Luggage;
use App\Entity\Photo;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture {

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $user = new User();
        $user->setEmail('admin@admin.fr');
        $plainPassword = 'azerty';
        $encoded = $this->encoder->encodePassword($user, $plainPassword);
        $user->setPassword($encoded);
        $manager->persist($user);

        $luggages = [];

        for($i = 0; $i < 50; $i++){
            $luggage = new Luggage();
            $luggages[]=$luggage;
            $luggage->setName($faker->text(8));
            $luggage->setDescription($faker->text(20));
            $luggage->setAvailable($faker->boolean);
            $luggage->setPrice($faker->randomFloat(2,10,30));
            $luggage->setHeight($faker->randomFloat(2,100,200));
            $luggage->setWidth($faker->randomFloat(2,100,200));
            $luggage->setLength($faker->randomFloat(2,100,200));
            $luggage->setWeight($faker->randomFloat(2,500,5000));

            $manager->persist($luggage);
        }
        $manager->flush();

        for($i =0; $i < 200; $i++){

            $photo = new Photo();
            $photo->setLink($faker->imageUrl(120, 180, 'cats'));     // 'http://lorempixel.com/800/600/cats/'
            $photo->setLuggage($faker->randomElement($luggages));
            $manager->persist($photo);
        }
        $manager->flush();
    }
}
