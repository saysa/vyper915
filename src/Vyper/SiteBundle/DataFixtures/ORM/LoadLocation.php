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
use Vyper\SiteBundle\Entity\Location;


class Loadlocation extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $names = array(
            'L\'Olympia' => array(
                'town' => 'Paris',
                'address' => '28 Boulevard des Capucines, 75009 Paris',
                'url' => 'http://www.olympiahall.com/',
                'googlemap' => 'Olympia Paris',
            ),
            'Le Divan du Monde' => array(
                'town' => 'Paris',
                'googlemap' => 'Le+Divan+Du+Monde+Paris',
            ),
            'Double Mixte' => array(
                'town' => 'Villeurbanne',
                'address' => '19 Avenue Gaston Berger
69625 VILLEURBANNE',
                'url' => 'http://www.doublemixte.com/',
                'googlemap' => 'Double Mixte Villeurbanne',
            ),
            'Le Trianon' => array(
                'town' => 'Paris',
                'googlemap' => 'le trianon paris',
            ),
            'Bar Live 301' => array(
                'town' => 'Roubaix',
                'address' => 'Bar Live 301
301 Avenue des Nations Unies
59100 Roubaix',
                'url' => 'https://www.facebook.com/pages/Bar-Live-301/157691184260903',
                'googlemap' => 'Bar Live 301 Roubaix',
            ),
            'Café International'  => array(
                'town' => 'Besançon',
                'address' => 'Café International
Cité Canot
73 quai Veil Picard
25000 Besançon',
                'googlemap' => '73 quai Veil Picard
25000 Besançon',
            ),
            'J.E LiveHouse' => array(
                'town' => 'Villepinte',
                'address' => 'Parc des Expositions de Paris-Nord Villepinte
93420 Villepinte',
                'url' => 'http://www.japan-expo.com/',
                'googlemap' => 'Parc des Expositions de Paris-Nord Villepinte
93420 Villepinte',
            ),
            'La Machine du Moulin Rouge' => array(
                'town' => 'Paris',
                'address' => '90 Boulevard de Clichy, 75018 Paris',
                'url' => 'www.lamachinedumoulinrouge.com',
                'googlemap' => '90 Boulevard de Clichy, 75018 Paris',
            ),
            'Japannecy' => array(
                'town' => 'Annecy',
                'address' => '54 bis rue des Marquisats, 74000',
                'url' => 'https://www.facebook.com/pages/JAPANNECY/203612929509',
                'googlemap' => '54 bis rue des Marquisats, 74000',
            ),
            'La Java' => array(
                'town' => 'Paris',
                'address' => '105 Rue du Faubourg du Temple, 75010 Paris ‎',
                'googlemap' => 'La java 105 Rue du Faubourg du Temple, 75010 Paris',
            ),
            'Le Bataclan' => array(
                'town' => 'Paris',
                'address' => '50 Boulevard Voltaire
75011 Paris',
                'url' => 'https://www.facebook.com/pages/JAPANNECY/203612929509',
                'googlemap' => '50 Boulevard Voltaire
75011 Paris',
            ),
            'Ninkasi Kao' => array(
                'town' => 'Lyon',
            ),
            'Mang\'Azur' => array(
                'town' => 'Toulon',
                'googlemap' => 'Place Besagne, 83000 Toulon',
            ),
            'Anime North' => array(
                'town' => 'Toronto',
                'address' => 'Toronto Congress Center
650 Dixon Road
Toronto, CANADA',
                'url' => 'http://www.animenorth.com/live/',
                'googlemap' => 'Toronto Congress Center
650 Dixon Road
Toronto, CANADA',
            ),
            'Animethon' => array(
                'town' => 'Edmonton',
                'address' => 'MacEwan University,
City Center Campus
Edmonton
Canada',
                'url' => 'http://www.animethon.org/',
                'googlemap' => 'MacEwan University,
City Center Campus
Edmonton
Canada',
            ),
            'La Marquise' => array(
                'town' => 'Lyon',
                'address' => '20 Quai Victor Augagneur, 69003 Lyon',
                'googlemap' => '20 Quai Victor Augagneur, 69003 Lyon',
            ),
            'La Cigale' => array(
                'town' => 'Paris',
                'address' => '120 Boulevard de Rochechouart, 75018 Paris',
                'googlemap' => '120 Boulevard de Rochechouart, 75018 Paris',
            ),
            'Covent Garden Studios' => array(
                'town' => 'Eragny-sur-Oise',
                'address' => 'Rue du Bouvreuil, 95610 Éragny',
                'googlemap' => 'Rue du Bouvreuil, 95610 Éragny',
            ),
            'HellFest' => array(
                'town' => 'Clisson',
                'address' => 'Rue du Champ Louet
44190 CLISSON',
                'googlemap' => 'Rue du Champ Louet
44190 CLISSON',
            ),
            'La Laiterie' => array(
                'town' => 'Strasbourg',
                'address' => 'Rue Du Ban de la Roche,
67000 Strasbourg',
                'googlemap' => 'Rue Du Ban de la Roche,
67000 Strasbourg',
            ),
            'SECRET PLACE' => array(
                'town' => 'Montpellier',
                'address' => '25 Rue Saint-Exupéry
34430 Saint-Jean-de-Védas',
                'googlemap' => '25 Rue Saint-Exupéry
34430 Saint-Jean-de-Védas',
            ),
            'JapanFM' => array(
                'town' => 'Sèvres',
                'address' => '8 rue Camille Desmoulins
92310 Sèvres',
                'googlemap' => '8 rue Camille Desmoulins
92310 Sèvres',
            ),
            'Zénith de Paris' => array(
                'town' => 'Paris',
                'url' => 'http://www.zenith-paris.com/pages/accueil/bienvenue.html',
                'address' => '211 Avenue Jean Jaurès, 75019 Paris',
                'googlemap' => '211 Avenue Jean Jaurès, 75019 Paris',
            ),
            'EVENTIM APOLLO HAMMERSMITH' => array(
                'town' => 'Londres',
                'url' => 'http://www.eventimapollo.com/',
                'address' => '45 Queen Caroline Street, London, England',
                'googlemap' => '45 Queen Caroline Street, London, England',
            ),
            'Le Ferrailleur'=> array(
                'town' => 'Nantes',
                'url' => 'http://www.leferrailleur.fr/',
                'address' => 'Quai des Antilles, 44200 Nantes',
                'googlemap' => 'Quai des Antilles, 44200 Nantes',
            ),

        );



        $i = 0;
        foreach ($names as $name => $infos)
        {
            $list[$i] = new Location();
            $list[$i]->setName($name);
            $list[$i]->setCountry($this->getReference('country-france'));
            foreach ($infos as $col => $value)
            {
                if ($col == 'town') {
                    $list[$i]->setTown($value);
                }

                if ($col == 'address') {
                    $list[$i]->setAddress($value);
                }

                if ($col == 'url') {
                    $list[$i]->setUrl($value);
                }

                if ($col == 'googlemap') {
                    $list[$i]->setGooglemap($value);
                }
            }

            $manager->persist($list[$i]);
            $this->addReference('location-'.$i, $list[$i]);

            $i++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}