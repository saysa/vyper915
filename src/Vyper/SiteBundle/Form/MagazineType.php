<?php

namespace Vyper\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class MagazineType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('attr' => array('placeholder' => 'Title')))
            ->add('volume', 'text', array('attr' => array('placeholder' => 'Vol. number ex: 001 or 002')))
            ->add('formFrance', 'textarea')
            ->add('formOutremer', 'textarea')
            ->add('formInternational', 'textarea')
            ->add('content', 'textarea')
            ->add('pictureID', 'text', array('required' => false, 'attr' => array('placeholder' => 'Picture ID')))
            ->add('dateRelease', 'date', array('widget' => 'single_text'))
        ;

        // On ajoute une fonction qui va écouter un évènement
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,    // 1er argument : L'évènement qui nous intéresse : ici, PRE_SET_DATA
            function(FormEvent $event) { // 2e argument : La fonction à exécuter lorsque l'évènement est déclenché
                // On récupère notre objet Advert sous-jacent
                $magazine = $event->getData();

                // Cette condition est importante, on en reparle plus loin
                if (null === $magazine) {
                    return; // On sort de la fonction sans rien faire lorsque $advert vaut null
                }
                if (null !== $magazine->getId() && !is_null($magazine->getPicture())) {

                    $event->getForm()->add('pictureID', 'text', array('data' => $magazine->getPicture()->getId()));
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
            'data_class' => 'Vyper\SiteBundle\Entity\Magazine'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vyper_sitebundle_magazine';
    }
}
