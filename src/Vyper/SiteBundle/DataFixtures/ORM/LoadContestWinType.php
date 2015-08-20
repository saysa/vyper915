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
use Vyper\SiteBundle\Entity\ContestWinType;


class LoadContestWinType extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $names = array('Draw', 'First');

        foreach ($names as $i => $name)
        {
            $list[$i] = new ContestWinType();
            $list[$i]->setName($name);

            $manager->persist($list[$i]);

        }

        $this->addReference('contest-win', $list[$i]);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }

}