<?php

namespace App\DataFixtures;

use App\Entity\Luggage;
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

        for($i = 0; $i < 50; $i++){
            $luggage = new Luggage();
            $luggage->setName($faker->text(8));
            $luggage->setDescription($faker->text(20));
            $manager->persist($luggage);
        }
        $manager->flush();
    }
}
