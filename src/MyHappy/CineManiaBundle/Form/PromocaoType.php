<?php

namespace MyHappy\CineManiaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PromocaoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dataCriacao')
            ->add('dataValidade')
            ->add('descricao')
            ->add('filme')
            ->add('imagem')
            ->add('regra')
            ->add('cinema')
            ->add('cinefilo')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyHappy\CineManiaBundle\Entity\Promocao'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'myhappy_cinemaniabundle_promocao';
    }
}