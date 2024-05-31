<?php

namespace App\Form;

use App\Entity\GarbageMaterialRuralKattegattOstersjon;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class GarbageMaterialRuralFormType extends AbstractType
{
    /**
     * Builds the form with the specified fields.
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('material')
            ->add('percentage')
            ->add('submit', SubmitType::class)
        ;
    }
    /**
     * Sets the class of the object created in the form.
     */

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GarbageMaterialRuralKattegattOstersjon::class,
        ]);
    }
}
