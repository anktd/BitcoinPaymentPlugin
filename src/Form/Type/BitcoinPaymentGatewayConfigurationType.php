<?php

namespace Blockonomics\BitcoinPaymentPlugin\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

final class BitcoinPaymentGatewayConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('bitcoin_address', TextType::class, [
                'label' => 'Bitcoin Address',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a Bitcoin address.',
                    ]),
                ],
            ]);
    }
}