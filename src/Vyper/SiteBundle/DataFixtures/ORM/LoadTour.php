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
use Vyper\SiteBundle\Entity\Tour;


class LoadTour extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $names = array(
            'Gazette Tour 2014',
        );

        foreach ($names as $i => $name)
        {
            $list[$i] = new Tour();
            $list[$i]->setType($this->getReference('tour-type'));
            $list[$i]->setContinent($this->getReference('continent'));
            $list[$i]->setTitle($name);
            $list[$i]->setDescription($name);
            $list[$i]->setStart(new \DateTime("2014-07-01"));
            $list[$i]->setEnd(new \DateTime("2014-12-01"));

            $manager->persist($list[$i]);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}