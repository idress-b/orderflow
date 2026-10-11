<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Product;
use Override;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

final class ProductProcessor implements ProcessorInterface
{
    public function __construct(
        #[Autowire(service: 'api_platform.doctrine.orm.state.persist_processor')]
        private ProcessorInterface $persistProcessor
    ){}

    #[Override]
    public function process(
        mixed $data,
        Operation $operation,
        array $uriVariables = [],
        array $context = []): mixed
    {
       if($data instanceof Product){
        $data->setStock(0);
       }

       return $this->persistProcessor->process($data,$operation,$uriVariables,$context);
    }
}
