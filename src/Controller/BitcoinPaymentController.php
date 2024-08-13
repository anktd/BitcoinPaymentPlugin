<?php

declare(strict_types=1);

namespace Blockonomics\BitcoinPaymentPlugin\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BitcoinPaymentController extends AbstractController
{
    public function displayPaymentAction($orderId): Response
    {
        $order = $this->get('sylius.repository.order')->find($orderId);
        $payment = $order->getLastPayment();
        $bitcoinAddress = $payment->getMethod()->getGatewayConfig()->getConfig()['bitcoin_address'];

        return $this->render('@BlockonomicsBitcoinPaymentPlugin/payment.html.twig', [
            'bitcoin_address' => $bitcoinAddress,
        ]);
    }
}