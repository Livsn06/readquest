<?php

function getReadableDeviceName(string $userAgent): string
{
    $ua = strtolower($userAgent);

    if (str_contains($ua, 'iphone')) return 'iPhone';
    if (str_contains($ua, 'ipad')) return 'iPad';
    if (str_contains($ua, 'android')) return 'Android';
    if (str_contains($ua, 'mac')) return 'Mac';
    if (str_contains($ua, 'windows')) return 'Windows PC';
    if (str_contains($ua, 'linux')) return 'Linux Device';

    return 'Unknown Device';
}
