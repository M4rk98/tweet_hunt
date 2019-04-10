<?php
/**
 * Created by PhpStorm.
 * User: gangelmark
 * Date: 2019. 04. 08.
 * Time: 19:58
 */

namespace AppBundle\Form;

use AppBundle\Entity\Tweet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('search', TextType::class, [
                'attr' => array(
                    'placeholder' => 'Search...'
                )
            ])
            ->add('lang', ChoiceType::class, [
                'choices'  => [
                    'HU' => 'hu',
                    'EN' => 'en',
                    'DE' => 'de',
                    'NL' => 'nl'
                ],
            ])
            ->add('type', ChoiceType::class, [
                'choices'  => [
                    'mixed' => 'mixed',
                    'recent' => 'recent',
                    'popular' => 'popular',
                ],
            ])
            ->add('save', SubmitType::class, ['label' => 'FIND'])
        ;
    }

}