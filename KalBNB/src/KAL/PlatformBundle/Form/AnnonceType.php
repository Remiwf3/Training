<?php

namespace KAL\PlatformBundle\Form;

use KAL\PlatformBundle\Form\ImageType;
use Symfony\Component\Form\AbstractType;
use KAL\PlatformBundle\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AnnonceType extends ApplicationType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, $this->getConfiguration("Titre", "Titre de l'annonce"))
                ->add('slug', TextType::class, $this->getConfiguration("Adresse web","(automatique)", [ 'required'  => false ]))
                ->add('coverImage', UrlType::class, $this->getConfiguration("Url de l'mage principale", "Adresse de l'image"))           
                ->add('introduction', TextType::class, $this->getConfiguration("Introduction", "Description globale de l'annonce"))
                ->add('content', TextareaType::class, $this->getConfiguration("Description détaillée", "Description qui donne vraiment envie de venir chez vous !"))   
                ->add('rooms', IntegerType::class, $this->getConfiguration("Nombre de chambres", "Nombre de chambres disponnibles"))
                ->add('price', MoneyType::class, $this->getConfiguration("Prix par nuit", "Prix recherché") )
                ->add('images', CollectionType::class, [
                    'entry_type'   =>  ImageType::class,
                    'allow_add'     =>   true,
                    'allow_delete'  =>   true
        ])
            ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'KAL\PlatformBundle\Entity\Ad'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kal_platformbundle_ad';
    }


}
