<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Config;

class ArrayLoader implements ConfigLoader
{
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function load(): array
    {
        return $this->config;
    }
}
