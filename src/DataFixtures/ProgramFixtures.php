<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 5; $i++) {
            $program = new Program();
            $program->setTitle('Vendredi 13');
            $program->setSynopsis("Un groupe d'adolescents découvre le camp de Crystal 
                Lake en même temps que le terrifiant Jason Voorhees et ses intentions meurtrières...");
            $program->setCategory($this->getReference('category_Horreur'));
            $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }
}
