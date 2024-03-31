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
    
    final public function readResource(): string
    {
        $message = stream_get_line($this->getResource(), 8192, "\r\n");
        echo $message;
        return $message;
    }
    
    final public function writeResource(string $data): void
    {
        echo $data . PHP_EOL;
        fwrite($this->getResource(), $data . PHP_EOL);
    }
    
    abstract public function getContainer(): ContainerInterface;
}