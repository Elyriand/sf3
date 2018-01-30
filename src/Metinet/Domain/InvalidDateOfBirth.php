<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class InvalidDateOfBirth extends \Exception
{
    public static function mustNotBeInTheFuture(): self
    {
        return new self('Date Of Birth cannot be in the future');
    }
}
