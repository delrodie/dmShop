<?php

namespace App\Form;

use App\Entity\Album;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class AlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class,['attr'=>['class'=>'form-control', 'placeholder'=>"Titre de l'album", 'autocomplete'=>'off']])
            ->add('prixVente', IntegerType::class,['attr'=>['class'=>'form-control', 'placeholder'=>"",'autocomplete'=>"off"]])
            ->add('description', TextareaType::class,['attr'=>['class'=>'form-control', 'placeholder'=>"La description de l'album", 'rows'=>'9'], 'required'=>false])
            //->add('sticke', IntegerType::class,['attr'=>['class'=>'form-control', 'placeholder'=>"",'autocomplete'=>"off"]])
            //->add('distribue', IntegerType::class,['attr'=>['class'=>'form-control', 'placeholder'=>"",'autocomplete'=>"off"]])
            ->add('pochette', FileType::class,[
                'mapped'=>false,
                'required' =>false,
                'constraints'=>[
                    new File([
                        'maxSize' => '100000k',
                        'mimeTypes' =>[
                            'image/png',
                            'image/jpeg',
                            'image/jpg',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => "Votre fichier doit être de type image"
                    ])
                ],
            ])
            //->add('slug')
            //->add('stock')
            ->add('artiste', EntityType::class,[
                'attr'=>['class'=>'form-control rubrique-select'],
                'class'=> 'App\Entity\Artiste',
                'query_builder' => function(EntityRepository $er){
                    return $er->liste();
                },
                'choice_label' => 'nom',
                'label' => 'Artiste',
                'required'=>true,
                'multiple' => false
            ])
            ->add('genre', EntityType::class,[
                'attr'=>['class'=>'form-control rubrique-select'],
                'class'=> 'App\Entity\Genre',
                'query_builder' => function(EntityRepository $er){
                    return $er->liste();
                },
                'choice_label' => 'libelle',
                'label' => 'Genre',
                'required'=>true,
                'multiple' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Album::class,
        ]);
    }
}
