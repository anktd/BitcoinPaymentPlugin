<?php

declare(strict_types=1);

namespace Blockonomics\BitcoinPaymentPlugin\Payum\Factory;

use Payum\Core\Bridge\Spl\ArrayObject;
use Payum\Core\GatewayFactory;

final class BitcoinPaymentGatewayFactory extends GatewayFactory
{
    protected function populateConfig(ArrayObject $config): void
    {
        $config->defaults([
            'payum.factory_name' => 'bitcoin_payment',
            'payum.factory_title' => 'Bitcoin Payment',
        ]);
    }
}