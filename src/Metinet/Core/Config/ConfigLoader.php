<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Config;

interface ConfigLoader
{
    public function load(): array;
}
