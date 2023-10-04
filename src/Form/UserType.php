<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mail', EmailType::class)
            ->add('phone', TelType::class)
            ->add('postcode', TextType::class, ['attr' => [
                'pattern' => '[0-9]{5}',
            ]])
            ->add('city', TextareaType::class, ['attr' => [
                'minlength' => 3,
                'maxlength' => 100,
            ]])
            ->add('address', TextareaType::class, ['attr' => [
                'minlength' => 3,
                'maxlength' => 100,
            ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
