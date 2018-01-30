<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Config;

class ChainLoader implements ConfigLoader
{
    /** @var ConfigLoader[] */
    private $loaders;

    public function __construct(array $loaders)
    {
        $this->loaders = $loaders;
    }

    public function load(): array
    {
        $config = [];
        foreach ($this->loaders as $loader) {
            $config = array_merge_recursive($config, $loader->load());
        }

        return $config;
    }
}
