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
use Vyper\SiteBundle\Entity\Event;


class LoadEvent extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $names = array(
            'Gazette',
            'Beerus',
            'Whis',
            'Gylnarius',
        );

        $dates = array(
            'now',
            'tomorrow',
            'first day of July 2015',
            'first day of September 2015',
        );

        foreach ($names as $i => $name)
        {
            $randLocation = mt_rand(0, 20);

            $list[$i] = new Event();
            $list[$i]->setTitle($name);
            $list[$i]->setDescription($name);
            $list[$i]->setDate(new \DateTime($dates[$i]));
            $list[$i]->setTime(new \DateTime("10:08"));
            $list[$i]->setTimeEnd(new \DateTime("12:08"));
            $list[$i]->setLocation($this->getReference('location-'.$randLocation));
            $list[$i]->setTour($this->getReference('tour-0'));
            $list[$i]->setType($this->getReference('event-type-0'));
            $list[$i]->setSlug(uniqid());

            $manager->persist($list[$i]);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}