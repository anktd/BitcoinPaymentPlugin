<?php

declare(strict_types=1);

namespace Blockonomics\BitcoinPaymentPlugin\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('blockonomics_bitcoin_payment');
        $rootNode = $treeBuilder->getRootNode();

        return $treeBuilder;
    }
}