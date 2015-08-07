<?php
/**
 * Created by PhpStorm.
 * User: saysa
 * Date: 09/09/2014
 * Time: 07:15
 */

namespace Vyper\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Vyper\SiteBundle\Entity\MangaType;


class MangaTypes implements FixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $names = array(
            'Policier',
            'Comédie',
            'Drame',
            'Psychologie',
            'Science-Fiction',
            'Surnaturel',
            'Thriller',
            'Suspense',
            'Comic',
            'Sport',
            'Ecole',
            'Adulte',
            'Hentai',
            'Shojo',
            'Shonen',
            'Compétition',
            'Horreur',
            'Mystère',
            'Aventure',
            'Action',
            'Romance',
        );

        foreach ($names as $i => $name)
        {
            $list_continents[$i] = new MangaType();
            $list_continents[$i]->setName($name);

            $manager->persist($list_continents[$i]);
        }

        $manager->flush();
    }
}