<?php
/**
 * Created by PhpStorm.
 * User: saysa
 * Date: 17/11/14
 * Time: 22:51
 */

namespace Vyper\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadUser extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $names = array(

            array(
                'username' => 'Saysa',
                'email' => 'saysa@vyper-jmusic.com',
                'password' => 'Saysa',
                'role' => array('ROLE_SAYSA', 'ROLE_ADMIN', 'ROLE_REDAC'),
            ),
            array(
                'username' => 'Cyrielle',
                'email' => 'cyrielle@vyper-jmusic.com',
                'password' => 'Cyrielle',
                'role' => array('ROLE_ADMIN', 'ROLE_REDAC'),
            ),
            array(
                'username' => 'Allyson',
                'email' => 'allyson@vyper-jmusic.com',
                'password' => 'Allyson',
                'role' => array('ROLE_ADMIN', 'ROLE_REDAC'),
            ),
            array(
                'username' => 'RedacV',
                'email' => 'redacv@vyper-jmusic.com',
                'password' => 'RedacV',
                'role' => array('ROLE_REDAC'),
            ),
            array(
                'username' => 'RedacP',
                'email' => 'redacp@vyper-jmusic.com',
                'password' => 'RedacP',
                'role' => array('ROLE_REDAC'),
            ),
        );

        $i = 0;
        foreach ($names as $k => $infos)
        {
            // Create a new user
            $user = $userManager->createUser();
            $user->setUsername($infos['username']);
            $user->setEmail($infos['email']);
            $user->setPlainPassword($infos['password']);
            $user->setEnabled(true);
            $user->setRoles($infos['role']);

            $manager->persist($user);

            if ($i == 1) {
                $this->addReference('user', $user);
            }

            $i++;
        }

        $manager->flush();

    }

    public function getOrder()
    {
        return 1;
    }
}