<?php

namespace App\Helper;

use DateTime;

class LocationHelper
{
     public function orderByProximity( $reference, $locations )
    {

        foreach ($locations as $location ){
            $lat1 = $reference['X'];
            $lon1 = $reference['Y'];
            $lat2 = $location['X'];
            $lon2 = $location['Y'];

            $dLat = deg2rad($lat2 - $lat1);
            $dLon = deg2rad($lon2 - $lon1);

            $a = sin($dLat / 2) * sin($dLat / 2) + cos($lat1) * cos($lat2) * sin($dLon / 2) * sin($dLon / 2);
            $c = 2 * asin(sqrt($a));

            $distances[] = array_merge([
                'distance' => 6371 * $c,
                'X' => $location['X'],
                'Y' => $location['Y'],
                'name' => $location['name'],
                'id' => $location['id'],
                'opensAt' => $location['opensAt'],
                'closesAt' => $location['closesAt']
                ]);
        }

        usort( $distances, function ($a, $b){
           return $a['distance'] <=> $b['distance'];
        });

        return array_map(function($item) {
            unset($item['distance']);
            return $item;
        }, $distances);
    }

    public function checkOpenLocation($hour, $locations)
    {
        $time = DateTime::createFromFormat('H:i', $hour);

        $index = 0;
        foreach ( $locations as $location) {

            $opens = DateTime::createFromFormat('H:i', $location['opensAt']);
            $closes = DateTime::createFromFormat('H:i', $location['closesAt']);

            $locations[$index]['status'] = $time >= $opens && $time <= $closes ? 'open' : 'closed';
            $index++;
        }

        return $locations;

    }
}
