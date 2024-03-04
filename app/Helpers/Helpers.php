<?php

namespace App\Helpers;

class GeoHelper
{
    public static function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Radius of the earth in kilometers

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = pow(sin($dLat / 2), 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            pow(sin($dLon / 2), 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c; // Distance in kilometers

        return $distance;
    }
}
