<?php
namespace App\Form;

use App\Entity\Country;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class ListType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastName', TextType::class, [
                    'attr' => ['rows' => 6, 'placeholder' => "Nom"],
                    'label' => false
                ]
            )
            ->add('firstName', TextType::class, [
                    'attr' => ['rows' => 6, 'placeholder' => "Prénom"],
                    'label' => false
                ]
            )
            ->add('countryCode', EntityType::class, [
                    'class' => Country::class,
                    'choice_label'  => 'code',
                    'label' => false
                ]
            )
            ->add('phoneNumberNational', TextType::class, [
                    'attr' => ['rows' => 6, 'placeholder' => "N° téléphone"],
                    'label' => false
                ]
            )
            ->add('send', SubmitType::class, [
                'label' => 'Call me !'
            ])

        ;
    }
}
