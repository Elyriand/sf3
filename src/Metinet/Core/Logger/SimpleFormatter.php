<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Logger;

class SimpleFormatter implements Formatter
{
    private $format;

    public function __construct(string $format = '%date% %time% %message% %url%')
    {
        $this->format = $format;
    }

    public function format(string $message, array $context): string
    {
        return str_replace(
            ['%date%', '%message%', '%url%'],
            [date(DATE_ATOM), $message, $context['url'] ?? ''],
            $this->format
        );
    }
}
