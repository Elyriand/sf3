<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Config;

use Metinet\Core\Logger\FileLogger;
use Metinet\Core\Logger\Logger;
use Metinet\Core\Logger\BlackholeLogger;
use Metinet\Core\Logger\SimpleFormatter;

class LoggerFactory
{
    public static function create(array $loggerConfig): Logger
    {
        $loggerType = $loggerConfig['type'];

        switch ($loggerType) {
            case 'blackhole':
                $logger = new BlackholeLogger();
                break;
            case 'file':
                $logger = new FileLogger(
                    $loggerConfig['path'],
                    new SimpleFormatter($loggerConfig['format'])
                );
                break;
            default:
                throw new \Exception(sprintf('Unknown logger type: "%s"', $loggerType));
        }

        return $logger;
    }
}
