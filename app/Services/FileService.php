<?php
namespace App\Services;

use Illuminate\Support\Facades\File;

class FileService{

    static function make(){ return new static(); }

    function replaceExtension( $oldPath, $newExtension )
    {
        $oldPath = explode( '.', $oldPath );
        array_pop( $oldPath );
        $oldPath = implode( '.', $oldPath );

        return $oldPath . '.' . $newExtension;
    }    

    public function findFileByName( $folderPath, $fileName )
    {
        $folderFiles = File::allFiles( $folderPath );
        foreach(  $folderFiles as $file ) 
        {
            if ( $file->getFilename() == $fileName ) 
            {    
                return $file->getPath() . DIRECTORY_SEPARATOR . $fileName;
            }   
        }
    }

    public function getFolderPath( $path )
    {
        $folderPath =  explode(  DIRECTORY_SEPARATOR, $path );
        array_pop( $folderPath );
        $folderPath = implode(  DIRECTORY_SEPARATOR, $folderPath );
        return $folderPath;
    }
}
