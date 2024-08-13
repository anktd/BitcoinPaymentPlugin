<?php

namespace Blockonomics\BitcoinPaymentPlugin\EventListener;

use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class BitcoinPaymentListener
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function onOrderPayment(ResourceControllerEvent $event)
    {
        $order = $event->getSubject();
        $payment = $order->getLastPayment();

        if ($payment && $payment->getMethod()->getGatewayConfig()->getFactoryName() === 'bitcoin_payment') {
            $bitcoinAddress = $payment->getMethod()->getGatewayConfig()->getConfig()['bitcoin_address'] ?? null;

            $content = $this->twig->render('@BitcoinPaymentPlugin/_bitcoin_payment.html.twig', [
                'bitcoin_address' => $bitcoinAddress,
                'money' => [
                    'amount' => $payment->getAmount(),
                    'currency' => $payment->getCurrencyCode(),
                ],
            ]);

            $event->setResponse(new Response($content));
        }
    }
}