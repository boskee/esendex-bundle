<?php

namespace Boskee\EsendexBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VoiceMessageType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', 'hidden', array(
                'mapped' => false
            ))
            ->add('originator')
            ->add('recipient')
            ->add('body', 'textarea')
            ->add('locale', 'locale')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Boskee\EsendexBundle\Model\VoiceMessage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'boskee_esendexbundle_voice_message';
    }
}
