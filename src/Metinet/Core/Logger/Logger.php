<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Logger;

interface Logger
{
    public function log(string $message): void;
}
