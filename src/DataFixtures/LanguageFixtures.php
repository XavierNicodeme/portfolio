<?php

namespace App\DataFixtures;

use App\Entity\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LanguageFixtures extends Fixture
{
    public const LANGUAGES = [
        0 => [
            'name' => 'Symfony',
            'logo' => 'symfonylogo.png',
        ],
        1 => [
            'name' => 'PHP',
            'logo' => 'phplogo.png',
        ],
        2 => [
            'name' => 'JavaScript',
            'logo' => 'jslogo.png',
        ],
        3 => [
            'name' => 'HTML',
            'logo' => 'htmllogo.png',
        ],
        4 => [
            'name' => 'CSS',
            'logo' => 'csslogo.png',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach(self::LANGUAGES as $key => $languageInfos) {
            $language = new Language();
            $language->setName($languageInfos['name']);
            $language->setLogo($languageInfos['logo']);
            $manager->persist($language);
            $this->addReference('language_' . $key, $language);
        }

        $manager->flush();
    }
}
