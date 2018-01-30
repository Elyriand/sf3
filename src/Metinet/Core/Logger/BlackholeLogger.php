<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Logger;

class BlackholeLogger implements Logger
{
    public function log(string $message): void
    {
        // Do nothing
    }
}
