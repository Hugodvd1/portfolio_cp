<?php

namespace App\DataFixtures;

use App\Entity\Medias;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class MediaFixtures extends Fixture
{
    public const MEDIASLIST = [
        [
            'title' => 'laposte1.png',
        ],
        [
            'title' => 'image2.jpg',
        ],
        [
            'title' => 'image3.jpg',
        ],
        [
            'title' => 'image4.jpg',
        ],
        [
            'title' => 'image5.jpg',
        ],
        
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::MEDIASLIST as $key => $mediasTitle) {
            $media = new Medias();
            $media->setTitle($mediasTitle['title']);
            $manager->persist($media);
            // $media->($this->getReference('projects_' . random_int(0, 2)));
            $this->addReference('medias_' . $key, $media);
    
        }

        $manager->flush();
    }


    // public function getDependencies()
    // {
    //     // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
    //     return [
    //       ProjectFixtures::class,
    //     ];
    // }
}
