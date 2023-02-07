<?php

namespace App\DataFixtures;

use App\Entity\Projects;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Serializer\Encoder\DecoderInterface;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROJECTLIST = [
        [
            'title' => 'La poste - Ligne Bleue',
            'content' => 'Dans le cadre d\'un projet scolaire, nous devions réaliser un project pour Ligne Bleue (branche de La Poste)',
            'objectif' => 'Rendre facile l\'accès au numérique pour les personnes agés ou en difficultés.',
        ],
        [
            'title' => 'Where is my Band',
            'content' => 'Dans le cadre d\'un projet avec la Wild Code School, nous devions réaliser un projet nous permettant d\'utiliser le modèle MVC.',
            'objectif' => 'Mettre en relation les groupes de musiques avec des musiciens.',
        ],
        [
            'title' => 'Portfolio fictif ',
            'content' => 'Dans le cadre d\'un projet avec la Wild Code School, nous devions réaliser un projet nous permettant de mettre en application notre récentes compétences apprises en CSS, HTML et JavaScript.',
            'objectif' => 'Mettre en avant le portfolio de notre personnage Fictif.',
        ],
    ];

    public static int $projectIndex = 0;

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROJECTLIST as $key => $projectInfo) {
            $project = new Projects();
            $project->setTitle($projectInfo['title']);
            $project->setContent($projectInfo['content']);
            $project->setObjectif($projectInfo['objectif']);
            $project->addMedia($this->getReference('medias_' . random_int(0, 4)));
            $manager->persist($project);
            $this->addReference('projects_' . $key, $project);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            MediaFixtures::class,
        ];
    }
}
