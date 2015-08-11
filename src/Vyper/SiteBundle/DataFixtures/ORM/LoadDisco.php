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
use Vyper\SiteBundle\Entity\Disco;


class LoadDisco extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $names = array(
            'Tragus',
            'Beautiful Deformity',
    'Division',
    'Toxic',
    'Traces, Best of 2005-2009',
    'Dim',
    'Stacked Rubbish',
    'Noumiso Gyakuten',
    'Nil',
    'Gama',
    'Disorder',
    'Madara',
    'Heisei Banka',
    'Hanko Seimeibun',
    'Super Margarita',
    'Akuyûkai',
    'Cockayne Soup',
            'Tragus',
            'Beautiful Deformity',
            'Division',
            'Toxic',
            'Traces, Best of 2005-2009',
            'Dim',
            'Stacked Rubbish',
            'Noumiso Gyakuten',
            'Nil',
            'Gama',
            'Disorder',
            'Madara',
            'Heisei Banka',
            'Hanko Seimeibun',
            'Super Margarita',
            'Akuyûkai',
            'Cockayne Soup',
            'Tragus',
            'Beautiful Deformity',
            'Division',
            'Toxic',
            'Traces, Best of 2005-2009',
            'Dim',
            'Stacked Rubbish',
            'Noumiso Gyakuten',
            'Nil',
            'Gama',
            'Disorder',
            'Madara',
            'Heisei Banka',
            'Hanko Seimeibun',
            'Super Margarita',
            'Akuyûkai',
            'Cockayne Soup',

        );

        $years = array(
            '2005',
            '2006',
            '2007',
            '2008',
            '2009',
            '2010',
            '2011',
            '2012',
            '2013',
            '2014',
        );

        for ($i=1;$i<=12;$i++) {
            $months[$i] = $i;
        }

        for ($i=1;$i<=28;$i++) {
            $days[$i] = $i;
        }

        for ($j=0;$j<=10;$j++) {
            foreach ($names as $i => $name)
            {
                $randArtist = mt_rand(0, 11);
                $randPic = mt_rand(5, 8);
                $year = $years[array_rand($years)];
                $month = array_rand($months);
                $day = array_rand($days);
                $datetime = "$year-$month-$day";

                $list[$i] = new Disco();
                $list[$i]->setTitle($name);
                $list[$i]->setCdJapan('F45D4D1');
                $list[$i]->setDate(new \DateTime($datetime));
                $list[$i]->setType($this->getReference('disco-type'));
                $list[$i]->setMedium($this->getReference('medium'));
                $list[$i]->setPicture($this->getReference('picture-'.$randPic));
                $list[$i]->setContinent($this->getReference('continent'));
                $list[$i]->setCountry($this->getReference('country'));
                $list[$i]->addArtist($this->getReference('artist-'.$randArtist));
                $list[$i]->setSlug(uniqid());


                $manager->persist($list[$i]);
            }
        }


        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }
}