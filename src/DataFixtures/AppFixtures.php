<?php

namespace App\DataFixtures;

use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Project;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('Fr-fr');
        for($i = 0; $i <= 5; $i++){
            $project = new Project();
            $project->setName($faker->word());
            $manager->persist($project);
        }

        $manager->flush();
    }
}