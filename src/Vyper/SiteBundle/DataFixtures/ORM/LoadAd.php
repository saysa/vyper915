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
use Vyper\SiteBundle\Entity\Ad;


class LoadAd extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $randPic = mt_rand(0, 4);

        $ads = array(
            array('type' => 0, 'locale' => 0),
            array('type' => 1, 'locale' => 0),
            array('type' => 0, 'locale' => 1),
            array('type' => 1, 'locale' => 1),
        );

        foreach($ads as $i => $ad) {
            $list[$i] = new Ad();
            $list[$i]->setLocale($this->getReference('locale-type-' . $ad['locale']));
            $list[$i]->setType($this->getReference('ad-type-' . $ad['type']));
            $list[$i]->setPicture($this->getReference('picture-'.$randPic));
            $list[$i]->setLink('http://www.google.com');
            $list[$i]->setActive(false);

            $manager->persist($list[$i]);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}