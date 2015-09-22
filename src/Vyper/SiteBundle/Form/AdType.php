<?php

namespace Vyper\SiteBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AdType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bgcolor', 'text', array('required' => false, 'attr' => array('placeholder' => '#FFFFFF')))
            ->add('link', 'text', array('required' => false, 'attr' => array('placeholder' => 'http:// (optional)')))
            ->add('type', 'entity', array(
                'class' => 'VyperSiteBundle:AdType',
                'property' => 'name',
            ))
            ->add('locale', 'entity', array(
                'class' => 'VyperSiteBundle:LocaleType',
                'property' => 'name',
            ))
            ->add('picture_fr_id', 'text', array('attr' => array('placeholder' => 'Picture FR ID')))
            ->add('picture_en_id', 'text', array('attr' => array('placeholder' => 'Picture FR ID')))

        ;

        // On ajoute une fonction qui va écouter un évènement
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,    // 1er argument : L'évènement qui nous intéresse : ici, PRE_SET_DATA
            function(FormEvent $event) { // 2e argument : La fonction à exécuter lorsque l'évènement est déclenché
                // On récupère notre objet Advert sous-jacent
                $ad = $event->getData();

                // Cette condition est importante, on en reparle plus loin
                if (null === $ad) {
                    return; // On sort de la fonction sans rien faire lorsque $advert vaut null
                }
                if (null !== $ad->getId()) {

                    $event->getForm()->add('$pictureFrID', 'text', array('data' => $ad->getPictureFr()->getId()));
                    $event->getForm()->add('$pictureEnID', 'text', array('data' => $ad->getPictureEn()->getId()));
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
            'data_class' => 'Vyper\SiteBundle\Entity\Ad'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vyper_sitebundle_ad';
    }
}
