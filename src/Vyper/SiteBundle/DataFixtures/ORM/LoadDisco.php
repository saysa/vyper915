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
use Vyper\SiteBundle\Entity\Disco;


class LoadDisco extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $names = json_decode(file_get_contents('src/Vyper/SiteBundle/DataFixtures/ORM/json/disco.json'));


            foreach ($names as $i => $name)
            {
                $randArtist = mt_rand(0, 11);
                $randPic = mt_rand(5, 8);

                $list[$i] = new Disco();
                $list[$i]->setTitle($name->title);
                $list[$i]->setTitleReal($name->titleReal);
                $list[$i]->setCdJapan($name->cdJapan);
                $list[$i]->setDate(new \DateTime($name->date));
                $list[$i]->setLabelMusic($name->label);
                $list[$i]->setType($this->getReference('disco-type'));
                $list[$i]->setMedium($this->getReference('medium'));
                $list[$i]->setPicture($this->getReference('picture-'.$randPic));
                $list[$i]->setContinent($this->getReference('continent'));
                $list[$i]->setCountry($this->getReference('country'));
                $list[$i]->addArtist($this->getReference('artist-'.$randArtist));
                $list[$i]->setSlug(uniqid());


                $manager->persist($list[$i]);
            }



        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }
}