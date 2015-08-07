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
use Vyper\SiteBundle\Entity\Album;


class Albums extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $names = array('News');

        foreach ($names as $i => $name)
        {
            $list[$i] = new Album();
            $list[$i]->setTitle($name);
            $list[$i]->setDescription($name);
            $list[$i]->setCategory($this->getReference('album-category'));
            $list[$i]->setSlug(uniqid());

            $manager->persist($list[$i]);
        }

        $this->addReference('album', $list[$i]);
        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}