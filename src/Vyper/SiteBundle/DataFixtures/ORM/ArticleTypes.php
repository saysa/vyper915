<?php
/**
 * Created by PhpStorm.
 * User: saysa
 * Date: 09/09/2014
 * Time: 07:15
 */

namespace Vyper\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Vyper\SiteBundle\Entity\ArticleType;


class ArticleTypes extends AbstractFixture implements FixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $names = array('Chronique', 'Interview', 'Live report', 'News', 'Magazine');

        foreach ($names as $i => $name)
        {
            $list[$i] = new ArticleType();
            $list[$i]->setName($name);

            $manager->persist($list[$i]);

            $this->addReference('article-type-'.$i, $list[$i]);
        }

        $manager->flush();
    }
}