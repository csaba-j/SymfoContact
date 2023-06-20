<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Hiba! Kérjük töltsd ki az összes mezőt!']),
                    new Length(['max' => 64,'maxMessage' => 'A neved nem lehet hosszabb, mint {{ limit }} karakter.'])
                ]
                
            ])
            ->add('email', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Hiba! Kérjük töltsd ki az összes mezőt!']),
                    new Email(['message' => 'Adj meg egy valós e-mail címet!']),
                    new Length(['max' => 64,'maxMessage' => 'Az e-mail címed nem lehet hosszabb, mint {{ limit }} karakter.'])
                ]
            ])
            ->add('message', TextareaType::class, [
                'attr' => ['rows' => 5, 'cols' => 50],
                'constraints' => [
                    new NotBlank(['message' => 'Hiba! Kérjük töltsd ki az összes mezőt!']),
                    new Length(['max' => 255,'maxMessage' => 'Az üzeneted nem lehet hosszabb, mint {{ limit }} karakter.'])
                ]
            ])
            ->add('submit', SubmitType::class, ['attr' => ['class' => 'btn btn-primary btn-lg px-5']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
