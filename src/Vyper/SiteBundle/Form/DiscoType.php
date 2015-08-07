<?php

namespace Vyper\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class DiscoType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('medium', 'entity', array(
                'class' => 'VyperSiteBundle:Medium',
                'property' => 'name',
            ))
            ->add('type', 'entity', array(
                'class' => 'VyperSiteBundle:DiscoType',
                'property' => 'name',
            ))
            ->add('country', 'entity', array(
                'class' => 'VyperSiteBundle:Country',
                'property' => 'name',
            ))
            ->add('continent', 'entity', array(
                'class' => 'VyperSiteBundle:Continent',
                'property' => 'name',
            ))
            ->add('title', 'text', array('attr' => array('placeholder' => 'Title')))
            ->add('titleReal', 'text', array('required' => false, 'attr' => array('placeholder' => 'Title Real')))
            ->add('cdJapan', 'text', array('required' => false, 'attr' => array('placeholder' => 'CDJapan')))
            ->add('itunes', 'text', array('required' => false, 'attr' => array('placeholder' => 'iTunes')))
            ->add('amazon', 'text', array('required' => false, 'attr' => array('placeholder' => 'Amazon')))
            ->add('date', 'date', array('widget' => 'single_text'))
            ->add('labelMusic', 'text', array('required' => false, 'attr' => array('placeholder' => 'Label')))
            ->add('details', 'textarea', array('required' => false))
            ->add('pictureID', 'text', array('required' => false, 'attr' => array('placeholder' => 'Picture ID')))
        ;

        // On ajoute une fonction qui va écouter un évènement
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,    // 1er argument : L'évènement qui nous intéresse : ici, PRE_SET_DATA
            function(FormEvent $event) { // 2e argument : La fonction à exécuter lorsque l'évènement est déclenché
                // On récupère notre objet Advert sous-jacent
                $disco = $event->getData();

                // Cette condition est importante, on en reparle plus loin
                if (null === $disco) {
                    return; // On sort de la fonction sans rien faire lorsque $advert vaut null
                }
                if (null !== $disco->getId() && !is_null($disco->getPicture())) {

                    $event->getForm()->add('pictureID', 'text', array('data' => $disco->getPicture()->getId()));
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
            'data_class' => 'Vyper\SiteBundle\Entity\Disco'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vyper_sitebundle_disco';
    }
}
