<?php

namespace App\DataFixtures;

use App\Entity\Tags;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TagsFixtures extends Fixture implements DependentFixtureInterface
{
    public const STACKSLIST = [
        [
            'stacks' => 'HTML',
        ],
        [
            'stacks' => 'MYSQL',
        ],
        [
            'stacks' => 'Symfony',
        ],
        [
            'stacks' => 'CSS',
        ],
        [
            'stacks' => 'SASS',
        ],
        [
            'stacks' => 'Developemment Web',
        ],
        [
            'stacks' => 'Responsive',
        ],
    ];


    public function load(ObjectManager $manager): void
    {
        foreach (self::STACKSLIST as $key => $stacksTitle) {
            $tags = new Tags();
            $tags->setStacks($stacksTitle['stacks']);
            $manager->persist($tags);
            $tags->addProject($this->getReference('projects_' . random_int(0, 2)));
            $this->addReference('tags_' . $key, $tags);
    
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          ProjectFixtures::class,
        ];
    }
}
