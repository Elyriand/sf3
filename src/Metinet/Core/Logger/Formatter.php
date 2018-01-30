<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Logger;

interface Formatter
{
    public function format(string $message, array $context): string;
}
