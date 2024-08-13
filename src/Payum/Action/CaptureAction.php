<?php

namespace Blockonomics\BitcoinPaymentPlugin\Payum\Action;

use Payum\Core\Action\ActionInterface;
use Payum\Core\Bridge\Spl\ArrayObject;
use Payum\Core\GatewayAwareInterface;
use Payum\Core\GatewayAwareTrait;
use Payum\Core\Request\Capture;
use Payum\Core\Exception\RequestNotSupportedException;

class CaptureAction implements ActionInterface, GatewayAwareInterface
{
    use GatewayAwareTrait;

    public function execute($request): void
    {
        RequestNotSupportedException::assertSupports($this, $request);

        $model = ArrayObject::ensureArrayObject($request->getModel());

        $bitcoinAddress = $this->gateway->getConfig()['payum.api']['bitcoin_address'];

        if (empty($bitcoinAddress)) {
            throw new \LogicException('The bitcoin_address in the gateway config is empty.');
        }

        // Here you would typically integrate with your Bitcoin payment provider
        // For testing, I am just using some dummy data
        $model['status'] = 'new';
        $model['currency'] = 'BTC';
        $model['bitcoin_address'] = $bitcoinAddress;
    }

    public function supports($request): bool
    {
        return
            $request instanceof Capture &&
            $request->getModel() instanceof \ArrayAccess;
    }
}