<?php

namespace App\DataFixtures;

use App\Entity\Projet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProjetFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROJETS = [
        'Megarama' => [
            'description' => 'Site statique du Megarama de Bordeaux, test des premières compétences',
            'link'        => 'https://github.com/StephanieAMANS/Megarama',
            'isGithub'    => true,
            'image'       => 'megarama-bordeaux.jpg',
            'languages'   => [
                'language_3',
                'language_4',
            ]
        ],
        'Musique Sauvage' => [
            'description' => 'Une plateforme ludique de partage de musique au sein de l\'école',
            'link'        => 'https://music.harari.ovh',
            'isGithub'    => false,
            'image'       => 'musics.png',
            'languages'   => [
                'language_1',
                'language_2',
                'language_3',
                'language_4',
            ]
        ],
        'Ali Perry' => [
            'description' => 'Jeu plateforme sur le thème de la musique pour le premier Hackathon de la Wild Code School',
            'link'        => 'https://github.com/XavierNicodeme/hackathonMVC',
            'isGithub'    => true,
            'image'       => 'AliPerry.png',
            'languages'   => [
                'language_2',
                'language_3',
                'language_4',
            ]
        ],
        'Fullbus' => [
            'description' => 'Leur mission ? Compléter les trajets à vide des compagnies d’autocars en offrant aux voyageurs une nouvelle façon de voyager, plus économique et plus responsable.',
            'link'        => 'https://fullbus.harari.ovh',
            'isGithub'    => false,
            'image'       => 'fullbussite.png',
            'languages'   => [
                'language_0',
                'language_1',
                'language_2',
                'language_3',
                'language_4',
            ]
        ],

    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::PROJETS as $projetName => $projetInfos) {
            $projet = new Projet();
            $projet->setName($projetName);
            $projet->setDescription($projetInfos['description']);
            $projet->setLink($projetInfos['link']);
            $projet->setIsGithub($projetInfos['isGithub']);
            $projet->setImage($projetInfos['image']);
            foreach($projetInfos['languages'] as $language) {
                $projet->addLanguage($this->getReference($language));
            }
            $manager->persist($projet);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            LanguageFixtures::class
        ];
    }
}
