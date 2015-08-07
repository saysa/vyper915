<?php

namespace Vyper\SiteBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ArticleType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('highlight', 'checkbox', array('required' => false))
            ->add('title', 'text', array('attr' => array('placeholder' => 'Title')))
            ->add('description', 'textarea', array('attr' => array('placeholder' => 'Description')))
            ->add('text', 'textarea')
            ->add('textEN', 'textarea', array('required' => false))
            ->add('textJP', 'textarea', array('required' => false))
            ->add('releaseDate', 'date', array('widget' => 'single_text'))
            ->add('releaseTime', 'time', array('widget' => 'single_text'))
            ->add('author', 'text', array('attr' => array('placeholder' => 'Author')))
            ->add('translator', 'text', array('required' => false, 'attr' => array('placeholder' => 'Translator')))
            ->add('source', 'text', array('required' => false, 'attr' => array('placeholder' => 'Source')))
            ->add('sourceURL', 'text', array('required' => false, 'attr' => array('placeholder' => 'Source URL')))
            ->add('metaKeywords', 'text', array('required' => false, 'attr' => array('placeholder' => 'META keywords separate with coma')))
            ->add('youtube', 'text', array('required' => false, 'attr' => array('placeholder' => 'ID Youtube')))
            ->add('articleType', 'entity', array(
                'class' => 'VyperSiteBundle:ArticleType',
                'property' => 'name',
            ))
            ->add('continent', 'entity', array(
                'class' => 'VyperSiteBundle:Continent',
                'property' => 'name',
            ))
            ->add('album', 'entity', array(
                'class' => 'VyperSiteBundle:Album',
                'property' => 'title',
                'query_builder' => function(EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('b')
                            ->orderBy('b.title');
                    },
                'required'    => false,
            ))
            ->add('theme', 'entity', array(
                'required' => false,
                'class' => 'VyperSiteBundle:Theme',
                'property' => 'title',
                'multiple' => true,
            ))
            ->add('pictureID', 'text', array('attr' => array('placeholder' => 'Picture ID')))

        ;

        // On ajoute une fonction qui va écouter un évènement
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,    // 1er argument : L'évènement qui nous intéresse : ici, PRE_SET_DATA
            function(FormEvent $event) { // 2e argument : La fonction à exécuter lorsque l'évènement est déclenché
                // On récupère notre objet Advert sous-jacent
                $article = $event->getData();

                // Cette condition est importante, on en reparle plus loin
                if (null === $article) {
                    return; // On sort de la fonction sans rien faire lorsque $advert vaut null
                }
                if (null !== $article->getId()) {

                    $event->getForm()->add('pictureID', 'text', array('data' => $article->getPicture()->getId()));
                }
            }
        );
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vyper\SiteBundle\Entity\Article'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vyper_sitebundle_article';
    }
}
