<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class UnableToSponsorCandidate extends \Exception
{
    public static function notEnoughSeniority(Student $student, Candidate $candidate)
    {
        return new self(
            sprintf(
                'Student "%s %s" has not enough seniority to sponsor Candidate "%s %s"',
                $student->getFirstName(),
                $student->getLastName(),
                $candidate->getFirstName(),
                $candidate->getLastName()
            )
        );
    }
}
