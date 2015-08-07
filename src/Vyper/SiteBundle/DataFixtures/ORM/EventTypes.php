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
use Vyper\SiteBundle\Entity\EventType;


class EventTypes implements FixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $names = array(
            'Concert',
            'Convention',
        );

        foreach ($names as $i => $name)
        {
            $list_continents[$i] = new EventType();
            $list_continents[$i]->setName($name);

            $manager->persist($list_continents[$i]);
        }

        $manager->flush();
    }
}