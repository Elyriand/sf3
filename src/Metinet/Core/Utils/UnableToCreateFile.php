<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Utils;

class UnableToCreateFile extends \Exception
{
    public static function permissionDenied($fullPathName): self
    {
        return new self(
            sprintf(
                "Unable to create '%s': PERMISSION DENIED",
                $fullPathName
            )
        );
    }
}
