<?php

declare(strict_types=1);

namespace Potter\Resource\Aware;

use \Psr\Container\ContainerInterface;

trait ResourceAwareTrait 
{
    private array $messageBuffer = [];
    
    final public function getResource(): mixed
    {
        return $this->getContainer()->get('resource');
    }
    
    final public function hasResource(): bool
    {
        return $this->getContainer()->has('resource');
    }
    
    final public function readResource(int $length): string
    {
        $messageBuffer = '';
        
        while ($message = fread($this->getResource(), $length) && strlen($message) > 0) {
            $messageBuffer .= $message;
        }
        if (strlen($messageBuffer) > 0) {
            array_push($this->messageBuffer, ...array_values(explode("\r\n", $messageBuffer)));
        }
        if (count($this->messageBuffer) == 0) {
            return '';
        }
        return ($this->lastMessage = array_shift($this->messageBuffer)) . PHP_EOL;
    }
    
    abstract public function getContainer(): ContainerInterface;
}