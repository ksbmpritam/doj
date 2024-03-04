<?php

namespace App\Helpers;

class Config
{
    static function getFirebaseApiKey()
    {
        return config('config.firebase.api_key');
    }

    static function getFirebaseDatabaseUrl()
    {
        return config('config.firebase.database_url');
    }
    
    static function fcm_server_key()
    {
        return config('config.firebase.fcm_server_key');
    }
    
    static function getGoogleMapsApiKey()
    {
        return config('config.google_maps.api_key');
    }
}
