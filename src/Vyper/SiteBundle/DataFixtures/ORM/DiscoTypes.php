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
use Vyper\SiteBundle\Entity\DiscoType;


class DiscoTypes extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $names = array(
            'Single',
            'Score Book',
            'PVS',
            'Mini-album',
            'Maxi-Single',
            'Documentary',
            'Concert',
            'Art-Book',
            'Album',
        );

        foreach ($names as $i => $name)
        {
            $list[$i] = new DiscoType();
            $list[$i]->setName($name);

            $manager->persist($list[$i]);
        }

        $manager->flush();

        $this->addReference('disco-type', $list[$i]);
    }

    public function getOrder()
    {
        return 1;
    }
}