<?php

declare(strict_types=1);

namespace Potter\Resource\Aware;

use \Psr\Container\ContainerInterface;

trait ResourceAwareTrait 
{
    final public function getResource(): mixed
    {
        return $this->getContainer()->get('resource');
    }
    
    final public function hasResource(): bool
    {
        return $this->getContainer()->has('resource');
    }
    
    abstract public function getContainer(): ContainerInterface;
}