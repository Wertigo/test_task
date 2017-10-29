<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\User;

class RegistrationType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type', ChoiceType::class, [
            'choices' => [
                'Client' => User::TYPE_CLIENT,
                'Seller' => User::TYPE_SELLER,
            ],
            'label' => 'Client type',
            'placeholder' => 'Choose client type',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    /**
     * @inheritdoc
     */
    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}