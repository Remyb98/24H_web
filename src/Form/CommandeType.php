<?php

namespace App\Form;

use App\Entity\Cafe;
use App\Entity\Commande;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateTimeType::class, [
                "attr" => ['hidden' => true]
            ])
            ->add('etat')
            ->add('quantite')
            // ->add('acheteur')
            // ->add('vendeur')
            ->add('cafe', EntityType::class, [
                'class' => Cafe::class,
                'choice_label' => function (Cafe $cafe) {
                    return $cafe->getNom() . " / " . $cafe->getProprietaire()->getEntreprise();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
