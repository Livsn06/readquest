<?php

function getTokenStructure(string $token): string
{
    return "Bearer {$token}";
}
