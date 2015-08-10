<?php
/**
 * Created by PhpStorm.
 * User: saysa
 * Date: 09/09/2014
 * Time: 07:15
 */

namespace Vyper\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Vyper\SiteBundle\Entity\Artist;


class LoadArtist extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $names = array(
            'Antoine',
            'Amelie',
            'Aurelie',
            'Anousack',
            'Arnaud',
            'Audrey',
            'Amaury',
            'Benoit',
            'Bruno',
            'Brigitte',
            'Bernard',
            'Bernd',
            'Broly',
            'Celine',
            'Cecile',
            'Emile',
            'Melanie',
            'Gazette',
            'Gerard',
            'Zao',
            'ALI PROJECT',
'Alice Nine',
'An Cafe',
'Ayabie',
'D',
'DaizyStripper',
'Deathgaze',
'Deluhi',
'D\'espairsRay',
'Dio - Distraught Overlord',
'Dir en grey',
'Dolly',
'Galneryus',
'Ghost',
'Girugämesh',
'Guniw Tools',
'Gackt',
'Golden Bomber',
'Malice Mizer',
'Madeth Gray\'ll',
'Matenrou Opera',
'Merry',
'Miyavi',
'Moi dix Mois',
'MUCC',
'Schwarz Stein',
'Shazna',
'Sid',
'Sincrea',
'SuG',
'VAMPS',
'Versailles',
'Vidoll',
'Vistlip',
            '12012',
        );

        foreach ($names as $i => $name)
        {
            $randPic = mt_rand(0, 4);

            $list[$i] = new Artist();
            $list[$i]->setName($name);
            $list[$i]->setProfile($name);
            $list[$i]->setKeywords($name);
            $list[$i]->setVyper(false);
            $list[$i]->setPicture($this->getReference('picture-'.$randPic));
            $list[$i]->setSlug(uniqid());

            $manager->persist($list[$i]);
            $this->addReference('artist-'.$i, $list[$i]);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}