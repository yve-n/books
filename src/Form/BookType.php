<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title', TextType::class,[
            'label'=>'title',
            'attr'=> [
                'class' => 'form-control',
            ],
        ])
        ->add('price', NumberType::class,[
            'label'=>'price',
            'attr'=> [
                'class' => 'form-control',
            ],
        ])
            ->add('author', TextType::class,[
                'label'=>'author',
                'attr'=> [
                    'class' => 'form-control',
                ],
            ])
            ->add('description', TextareaType::class,[
                'label'=>'Description',
                'attr'=> [
                    'class' => 'form-control',
                ],
            ])
            ->add('images', FileType::class,[
                'label' => 'Select Image',
                'required' => false,
                'multiple' => true,
                'mapped' => false,
            ])    
            ->add('category', EntityType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'category',
                'class' => Category::class,
                'choice_label' => 'name',
            ]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
