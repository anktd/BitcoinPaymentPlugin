<?php

declare(strict_types=1);

namespace Blockonomics\BitcoinPaymentPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class BitcoinPaymentPlugin extends Bundle
{
    use SyliusPluginTrait;
}