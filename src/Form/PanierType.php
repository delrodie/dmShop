<?php

namespace App\Form;

use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PanierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('reference')
            ->add('nom', TextType::class,['attr'=>['class'=>'form-control form-control-sm', 'autocomplete'=>"off"]])
            ->add('tel', TelType::class,['attr'=>['class'=>'form-control form-control-sm', 'autocomplete'=>"off"]])
            ->add('adresse', TextType::class,['attr'=>['class'=>'form-control form-control-sm', 'autocomplete'=>"off"]])
            ->add('email', EmailType::class, ['attr'=>['class'=>'form-control form-control-sm', 'autocomplete'=>"off"]])
            //->add('quantite')
            //->add('montant')
            //->add('flag')
            ->add('commune',ChoiceType::class,[
                'attr'=>['class'=>'form-control form-control-lg commune', 'autocomplete'=>"off"],
                'choices'=>[
                    'ABIDJAN' => [
                        'Abobo' => "ABOBO",
                        'Adjame' => "ADJAME",
                        'Attecoube' => "ATTECOUBE",
                        'Anyama' => "ANYAMA",
                        'Bingerville' => "BINGERVILLE",
                        'Cocody' => "COCODY",
                        'Koumassi' => "KOUMASSI",
                        'Marcory' => "MARCORY",
                        'Plateau' => "PLATEAU",
                        'Port-Bouet' => 'PORT BOUET',
                        'Treichville'=> "TREICHVILLE",
                        'Yopougon' => "YOPOUGON",
                    ],
                    'INTERIEUR' => [
                        'Autre ville' => "AUTRE"
                    ],
                ]
            ])
            //->add('album')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
