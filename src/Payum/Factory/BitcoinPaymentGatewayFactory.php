<?php

namespace Blockonomics\BitcoinPaymentPlugin\Payum\Factory;

use Payum\Core\Bridge\Spl\ArrayObject;
use Payum\Core\GatewayFactory;
use Blockonomics\BitcoinPaymentPlugin\Payum\Action\CaptureAction;
use Blockonomics\BitcoinPaymentPlugin\Payum\Action\StatusAction;

class BitcoinPaymentGatewayFactory extends GatewayFactory
{
    protected function populateConfig(ArrayObject $config): void
    {
        $config->defaults([
            'payum.factory_name' => 'bitcoin_payment',
            'payum.factory_title' => 'Bitcoin Payment',
        ]);

        if (!$config['payum.api']) {
            $config['payum.default_options'] = [
                'bitcoin_address' => '',
            ];
            $config->defaults($config['payum.default_options']);
            $config['payum.required_options'] = ['bitcoin_address'];

            $config['payum.api'] = function (ArrayObject $config) {
                $config->validateNotEmpty($config['payum.required_options']);

                return new \ArrayObject([
                    'bitcoin_address' => $config['bitcoin_address'],
                ]);
            };
        }

        $config['payum.paths'] = array_replace([
            'BitcoinPaymentPlugin' => __DIR__.'/../../Resources/views',
        ], $config['payum.paths'] ?: []);

        $config['payum.action.capture'] = new CaptureAction();
        $config['payum.action.status'] = new StatusAction();
    }
}