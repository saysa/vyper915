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
use Vyper\SiteBundle\Entity\Artist;


class LoadArtist extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        $names = json_decode(file_get_contents('src/Vyper/SiteBundle/DataFixtures/ORM/json/artist.json'));

        foreach ($names as $i => $name)
        {
            $randPic = mt_rand(0, 4);

            $list[$i] = new Artist();
            $list[$i]->setName($name->name);
            $list[$i]->setRealName($name->realName);
            $list[$i]->setProfile($name->profile);
            $list[$i]->setBiography($name->biography);
            $list[$i]->setKeywords($name->keywords);
            $list[$i]->setVyper(true);
            $list[$i]->setPicture($this->getReference('picture-'.$randPic));
            $list[$i]->setSlug(uniqid());

            $manager->persist($list[$i]);
            $this->addReference('artist-'.$i, $list[$i]);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}