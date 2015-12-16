<?php

namespace Etakeaway\Entity\Utils;

/**
 * Trait for formatting times.
 */
trait TimeFormatTrait
{
    /**
     * Format a DateTime object as 'Y-m-d\TH:i:s'.
     *
     * @param \DateTime $time DateTime object to format.
     *
     * @return string Date and time in the format 'Y-m-d\TH:i:s'.
     */
    public function formatTime(\DateTime $time)
    {
        return $time->format('Y-m-d\TH:i:s');
    }
}
