<?php

namespace Blockonomics\BitcoinPaymentPlugin\Payum\Action;

use Payum\Core\Action\ActionInterface;
use Payum\Core\Request\GetStatusInterface;
use Payum\Core\Bridge\Spl\ArrayObject;

class StatusAction implements ActionInterface
{
    public function execute($request): void
    {
        /** @var GetStatusInterface $request */
        $model = ArrayObject::ensureArrayObject($request->getModel());

        if (!isset($model['status']) || $model['status'] === null) {
            $request->markNew();
            return;
        }

        if ($model['status'] === 'paid') {
            $request->markCaptured();
            return;
        }

        if ($model['status'] === 'failed') {
            $request->markFailed();
            return;
        }

        $request->markUnknown();
    }

    public function supports($request): bool
    {
        return
            $request instanceof GetStatusInterface &&
            $request->getModel() instanceof \ArrayAccess;
    }
}