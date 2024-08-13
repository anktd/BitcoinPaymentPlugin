<?php

declare(strict_types=1);

namespace Blockonomics\BitcoinPaymentPlugin\Payum\Action;

use Payum\Core\Action\ActionInterface;
use Payum\Core\Request\Capture;
use Payum\Core\Exception\RequestNotSupportedException;

final class CaptureAction implements ActionInterface
{
    public function execute($request): void
    {
        RequestNotSupportedException::assertSupports($this, $request);

        $model = $request->getModel();

        // Here you would typically integrate with your Bitcoin payment provider
        // For now, we'll just set the status to 'new'
        $model['status'] = 'new';
        $model['currency'] = 'BTC';
    }

    public function supports($request): bool
    {
        return
            $request instanceof Capture &&
            $request->getModel() instanceof \ArrayAccess;
    }
}