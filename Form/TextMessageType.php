<?php

namespace Boskee\EsendexBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TextMessageType extends AbstractType
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
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Boskee\EsendexBundle\Model\TextMessage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'boskee_esendexbundle_text_message';
    }
}
