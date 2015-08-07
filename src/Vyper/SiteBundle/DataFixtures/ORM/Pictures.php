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
use Vyper\SiteBundle\Entity\Picture;


class Pictures extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $names = array(
            'file01.jpg',
            'file02.jpg',
            'file03.jpg',
            'file04.jpg',
            'file05.jpg',
            'cover01.jpg',
            'cover02.jpg',
            'cover03.jpg',
            'cover04.jpg',

        );

        foreach ($names as $i => $name)
        {
            $list[$i] = new Picture();
            $list[$i]->setFilename($name);
            $list[$i]->setName($name);
            $list[$i]->setMime($name);
            $list[$i]->setSize(300);
            $list[$i]->setWidth(300);
            $list[$i]->setHeight(300);
            $list[$i]->setAlbum($this->getReference('album'));

            $manager->persist($list[$i]);

            $this->addReference('picture-'.$i, $list[$i]);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}