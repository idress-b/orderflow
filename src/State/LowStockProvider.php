<?php

namespace App\State;

use App\Repository\ProductRepository;

final class LowStockProvider implements \ApiPlatform\State\ProviderInterface
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function provide(
        \ApiPlatform\Metadata\Operation $operation,
        array $uriVariables = [],

        array $context = []): iterable
    {
        $limit = $operation->getParameters()->get('limit')->getValue();
        return $this->productRepository->findLowStockProducts($limit);
    }
}
