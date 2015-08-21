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
use Vyper\SiteBundle\Entity\Magazine;


class LoadMagazine extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $names = array(
            'VYPER Magazine Vol 000',
            'VYPER Magazine Vol 001',
            'VYPER Magazine Vol 002',
            'VYPER Magazine Vol 003',
        );

        $dates = array(
            'first day of April 2015',
            'first day of June 2015',
            'first day of July 2015',
            'first day of September 2015',
        );

        $slugs = array(
            'vol00',
            'vol01',
            'vol02',
            'vol03',
        );

        foreach ($names as $i => $name)
        {
            $randPic = mt_rand(0, 4);

            $list[$i] = new Magazine();
            $list[$i]->setTitle($name);
            $list[$i]->setVolume($name);
            $list[$i]->setFormFrance($name);
            $list[$i]->setFormOutremer($name);
            $list[$i]->setFormInternational($name);
            $list[$i]->setContent($name);
            $list[$i]->setShopLink('http:://www.google.fr');
            $list[$i]->setDateRelease(new \DateTime($dates[$i]));
            $list[$i]->setPicture($this->getReference('picture-'.$i));
            $list[$i]->setSlug($slugs[$i]);

            $manager->persist($list[$i]);

            $this->addReference('magazine-'.$i, $list[$i]);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}