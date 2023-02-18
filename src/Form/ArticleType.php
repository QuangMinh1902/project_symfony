<?php

namespace App\Form;

use App\Entity\Article;
// use Doctrine\DBAL\Types\DateTimeType;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                "attr" => [
                    "class" => "form-control",
                    "minlength" => '2',
                    "maxlength" => "36"
                ],
                "label" => "Name",
                "label_attr" => [
                    "class" => "form-label mt-4",
                ]
            ])
            ->add('description',TextareaType::class, [
                "attr" => [
                    "class" => "form-control",
                ],
                "label" => "Description",
                "label_attr" => [
                    "class" => "form-label mt-4",
                ]
            ])
            ->add('price', MoneyType::class, [
                "attr" => [
                    "class" => "form-control ",
                    "minlength" => '1',
                    "maxlength" => "10"
                ],
                "label" => "Price",
                "label_attr" => [
                    "class" => "form-label mt-4 ",
                ]
            ])
            ->add('nombresAvailable', NumberType::class, [
                "attr" => [
                    "class" => "form-control",
                    "minlength" => '1',
                    "maxlength" => "10"
                ],
                "label" => "Nombre d'article disponible",
                "label_attr" => [
                    "class" => "form-label mt-4",
                ]
            ])
            
            ->add('category', EntityType::class, [
                "class" => Category::class,
                "choice_label" => "name",
                "attr" => [
                    "class" => "form-control",
                ],
                "label" => "Category",
                "label_attr" => [
                    "class" => "form-label mt-4",
                ]
                ])

            ->add('submit', SubmitType::class, [
                "attr" => [
                    "class" => "btn btn-primary mt-4",
                ],
                "label" => "Create",
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
