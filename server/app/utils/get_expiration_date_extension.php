<?php

function getExpirationDateExtension(bool $extended = false): DateTime
{
    $endDate = new DateTime();
    if ($extended) {
        $endDate->modify('+30 day');
    } else {
        $endDate->modify('+1 day');
    }

    return $endDate;
}
