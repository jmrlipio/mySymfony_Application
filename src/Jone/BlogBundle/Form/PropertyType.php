<?php

namespace Jone\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PropertyType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('propertyName')
            ->add('propertyDetail')
            ->add('propertyImage')
            ->add('slug')
            ->add('datePublished')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jone\BlogBundle\Entity\Property'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'jone_blogbundle_property';
    }
}
