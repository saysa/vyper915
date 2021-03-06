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
use Vyper\SiteBundle\Entity\Tour;


class LoadTour extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $names = json_decode(file_get_contents('src/Vyper/SiteBundle/DataFixtures/ORM/json/tour.json'));

        foreach ($names as $i => $name)
        {
            $list[$i] = new Tour();
            $list[$i]->setType($this->getReference('tour-type'));
            $list[$i]->setContinent($this->getReference('continent'));
            $list[$i]->setTitle($name->title);
            $list[$i]->setRealTitle($name->realTitle);
            $list[$i]->setDescription($name->description);
            $list[$i]->setStart(new \DateTime($name->start));
            $list[$i]->setEnd(new \DateTime($name->end));
            $list[$i]->setArtistsKeywords($name->artistsKeywords);

            $manager->persist($list[$i]);

            $this->addReference('tour-'.$i, $list[$i]);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}