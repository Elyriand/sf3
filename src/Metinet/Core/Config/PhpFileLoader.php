<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Config;

class PhpFileLoader implements ConfigLoader
{
    private $paths;

    public function __construct(array $paths)
    {
        $this->paths = $paths;
    }

    public function load(): array
    {
        $config = [];

        foreach ($this->paths as $path) {
            $config = array_merge_recursive($config, require $path);
        }

        return $config;
    }
}
