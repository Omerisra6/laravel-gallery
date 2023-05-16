<?php

namespace App\Services;

use Google\Service\Drive as ServiceDrive;
use Google_Client;
use Illuminate\Support\Collection;

class DriveService
{
    public static function getFileNames( Collection $ids )
    {
        $errors = collect( [] );

        $client = new Google_Client();
        $client->setDeveloperKey( env( 'GOOGLE_CLIENT_API_KEY' ) );

        $client->setScopes( ServiceDrive::DRIVE_METADATA_READONLY );
        $service = new ServiceDrive( $client );

       $names = $ids->map( function( $id ) use( $service, $errors ){
                       
            try{
                return $service->files->get( $id )->getName();
            }catch( \Exception $e){

                $errors->push( $id );
                return '';
            }
        });
       
        return [ 'errors' => $errors, 'names' => $names ];       
    }
}
