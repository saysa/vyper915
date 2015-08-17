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
use Vyper\SiteBundle\Entity\Video;


class LoadVideo extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $names = json_decode(file_get_contents('src/Vyper/SiteBundle/DataFixtures/ORM/json/video.json'));

        foreach ($names as $i => $name)
        {
            $list[$i] = new Video();
            $list[$i]->setPicture($this->getReference('picture-1'));
            $list[$i]->setTitle($name->title);
            $list[$i]->setYoutube($name->youtube);
            $list[$i]->setDescription($name->description);
            $list[$i]->setSlug($name->slug);

            $manager->persist($list[$i]);

        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}