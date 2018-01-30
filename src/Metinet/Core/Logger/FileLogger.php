<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Logger;

use Metinet\Core\Utils\FileTools;

class FileLogger implements Logger
{
    private $path;
    private $formatter;

    public function __construct(string $path, SimpleFormatter $formatter)
    {
        FileTools::createFileIfNotExists($path);
        $this->path = $path;
        $this->formatter = $formatter;
    }

    public function log(string $message, array $context = []): void
    {
        file_put_contents($this->path, $this->formatter->format($message, $context) . PHP_EOL, FILE_APPEND);
    }
}
