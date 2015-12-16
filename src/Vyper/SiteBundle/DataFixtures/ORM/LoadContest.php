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
use Vyper\SiteBundle\Entity\Contest;


class LoadContest extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $names = array(
            'Concours 1',
            'Concours 2',
        );

        $dates = array(
            'now',
            'tomorrow',
            'first day of October 2015',
            'first day of November 2015',
            'first day of December 2015',
            'first day of July 2016',
            'first day of September 2016',
        );

        foreach ($names as $i => $name)
        {
            $randLocation = mt_rand(1, 6);
            $randCalendar = mt_rand(0, 2);

            $list[$i] = new Contest();
            $list[$i]->setTitle($name);
            $list[$i]->setDescription($name);
            $list[$i]->setPrizes($name);
            $list[$i]->setHowMuchWinners(3);
            $list[$i]->setDate(new \DateTime($dates[0]));
            $list[$i]->setDateEnd(new \DateTime($dates[$randLocation]));
            $list[$i]->setTime(new \DateTime("10:08"));
            $list[$i]->setTimeEnd(new \DateTime("12:08"));
            $list[$i]->setContestWinType($this->getReference('contest-win'));
            $list[$i]->setSlug(uniqid());
            $list[$i]->setLocale($this->getReference('locale-type-1'));

            $manager->persist($list[$i]);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}