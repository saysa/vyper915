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
use Vyper\SiteBundle\Entity\Top;


class LoadTop extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i=1;$i<=10;$i++)
        {
            $randPic = mt_rand(5, 8);

            $list[$i] = new Top();
            $list[$i]->setType('music');
            $list[$i]->setPosition($i);
            $list[$i]->setTitle('');
            $list[$i]->setAuthor('');
            $list[$i]->setPicture($this->getReference('picture-'.$randPic));

            $manager->persist($list[$i]);
        }

        for ($i=1;$i<=10;$i++)
        {
            $randPic = mt_rand(5, 8);

            $list[$i] = new Top();
            $list[$i]->setType('ost');
            $list[$i]->setPosition($i);
            $list[$i]->setTitle('');
            $list[$i]->setAuthor('');
            $list[$i]->setPicture($this->getReference('picture-'.$randPic));

            $manager->persist($list[$i]);
        }



        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }
}