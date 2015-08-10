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
        $names = array(
            'Le portrait de Krilin',
            'Ils sont de retour',
            'Grand succès pour la sortie',
            'Les espagnols en rafolent',
            'Concert exceptionnelle chez les fous',
            'Le Real est inébranlable',
            'Amaury Levau se feit avoir',
            'Bruit sur la cafetière',
            'Ce soir on mange où ?',
            'Yen a marre de Malabar',
            'Bernard Minet au Zenith',
            'Pour la première',
            'Sortie ratée pour Le Bron',
            'Celine a jeté son tire',
            'Les écrans sont à plat',
            'Qualifications de fou ce soir',
            'Le chat est noir et il fait noir',
            'Gazette reste en concert',
            'Gerard Majax ce soir fait du cinéma',
            'Zao de Franco a glissé dans la marre',
        );
        for ($j=0;$j<=20;$j++) {
            foreach ($names as $i => $name)
            {


                $randAT = mt_rand(0, 6);
                $randPic = mt_rand(0, 4);

                $list[$i] = new Article();
                $list[$i]->setUser($this->getReference('user'));
                $list[$i]->setTitle($name);
                $list[$i]->setContinent($this->getReference('continent'));
                $list[$i]->setArticleType($this->getReference('article-type-'.$randAT));
                $list[$i]->setHighlight(true);
                $list[$i]->setDescription('Je suis une description');
                $list[$i]->setText('Je suis le contenu');
                $list[$i]->setReleaseDate(new \DateTime('now'));
                $list[$i]->setReleaseTime(new \DateTime('now'));
                $list[$i]->setAuthor('KiyoMi');
                $list[$i]->setPicture($this->getReference('picture-'.$randPic));
                $list[$i]->setSlug(uniqid());
                $list[$i]->setLive(true);

                $manager->persist($list[$i]);
            }
        }


        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}