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
use Vyper\SiteBundle\Entity\Article;


class LoadArticle extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $names = json_decode(file_get_contents('src/Vyper/SiteBundle/DataFixtures/ORM/json/article.json'));


            foreach ($names as $i => $name)
            {


                $randAT = mt_rand(0, 6);
                $randPic = mt_rand(0, 4);

                $list[$i] = new Article();
                $list[$i]->setUser($this->getReference('user'));
                $list[$i]->setTitle($name->title);
                $list[$i]->setContinent($this->getReference('continent'));
                $list[$i]->setArticleType($this->getReference('article-type-'.$randAT));
                $list[$i]->setHighlight($name->highlight);
                $list[$i]->setDescription($name->description);
                $list[$i]->setText($name->text);
                $list[$i]->setReleaseDate(new \DateTime($name->releaseDate));
                $list[$i]->setReleaseTime(new \DateTime($name->releaseTime));
                $list[$i]->setAuthor($name->author);
                $list[$i]->setMetaKeywords($name->metaKeywords);
                $list[$i]->setPicture($this->getReference('picture-'.$randPic));
                $list[$i]->setSlug(uniqid());
                $list[$i]->setLive($name->live);
                $list[$i]->setLocale('fr');

                $manager->persist($list[$i]);
            }



        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}