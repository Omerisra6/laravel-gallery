<?php

namespace App\Imports;

use App\Jobs\CaptureImage;
use App\Jobs\ConvertVideoForStreaming;
use App\Models\Video;
use App\Services\FileService;
use App\Services\VideoService;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class VideoImport implements OnEachRow, WithStartRow
{
    private $names;

    public function  __construct( $names )
    {
        $this->names = $names;
    }

    public function onRow( Row $row)
    {  
        $client            = $row[ 9 ];
        $keyWords          = $row[ 5 ];   
        $videoName         = $row[ 4 ];
        $projectNumber     = $row[ 3 ];
        $projectName       = $row[ 2 ];
        $resolution        = $row[ 6 ];
        $dateCreated       = $row[ 1 ];
        $driveUrl          = $row[ 7 ];
        
        $i = $row->getIndex() - 2;  

        $urlParts = explode( '/', $driveUrl );
        
        //if the url not exits skip 
        if ( count( $urlParts ) <= 5 ) 
        {
            return;
        }

        $videosFolder = public_path(  DIRECTORY_SEPARATOR . 'videos' );
        $path = FileService::make()->findFileByName( $videosFolder, $this->names[ $i ] );

        if ( ! $path ) 
        {
            return;
        }
        
        $path         = $this->adjustVideoPath( $path );
        $videoService = VideoService::make( $path );
        $resolution   = $videoService->resolution;
        $ratio        = $videoService->ratio;
        $duration     = $videoService->duration;

        $folderPath = FileService::make()->getFolderPath( $path );
        $imagePath  = $folderPath . DIRECTORY_SEPARATOR . now()->timestamp . '-FrameAt1sec.png';
        CaptureImage::dispatch( $path, $imagePath );

        $reducedPath = $folderPath .  DIRECTORY_SEPARATOR . now()->timestamp . '-'.$this->names[ $i ];
        $reducedPath = FileService::make()->replaceExtension( $reducedPath, 'mp4' );
        ConvertVideoForStreaming::dispatch( $reducedPath, $path );


        $wordsArray = explode( ',', $keyWords );
        array_push( $wordsArray, $resolution, $ratio, $videoName, $projectNumber, $projectName, $client, $dateCreated );
        $keyWords = implode( ', ', $wordsArray );

        Video::create( [
            'description'    => '',
            'title'          => $videoName,
            'duration'       => $duration,
            'key_words'      => $keyWords,
            'original_video' => $path,
            'reduced_video'  => $reducedPath,
            'image_display'  => $imagePath,
            'resolution'     => $resolution,
            'made_for'       => $client,
            'project_number' => strval( $projectNumber ),
            'ratio'          => $ratio,
        ]);
       
    }

    private function adjustVideoPath( $path )
    {
        $path = explode( '\\public\\/', $path );
        $path = array_pop( $path );
        $path = explode( '\\', $path );
        array_shift( $path );
        $path = implode( '/', $path );
        $path = '/' . $path;
        return $path;
    }

    public function startRow(): int
    {
        return 2;
    }
}

<?php

namespace App\Imports;

use App\Jobs\CaptureImage;
use App\Jobs\ConvertVideoForStreaming;
use App\Models\Video;
use App\Services\FileService;
use App\Services\VideoService;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class VideoImport implements OnEachRow, WithStartRow
{
    private $names;

    public function  __construct( $names )
    {
        $this->names = $names;
    }

    public function onRow( Row $row)
    {  
        $client            = $row[ 9 ];
        $keyWords          = $row[ 5 ];   
        $videoName         = $row[ 4 ];
        $projectNumber     = $row[ 3 ];
        $projectName       = $row[ 2 ];
        $resolution        = $row[ 6 ];
        $dateCreated       = $row[ 1 ];
        $driveUrl          = $row[ 7 ];
        
        $i = $row->getIndex() - 2;  

        $urlParts = explode( '/', $driveUrl );
        
        //if the url not exits skip 
        if ( count( $urlParts ) <= 5 ) 
        {
            return;
        }

        $videosFolder = public_path(  DIRECTORY_SEPARATOR . 'videos' );
        $path = FileService::make()->findFileByName( $videosFolder, $this->names[ $i ] );

        if ( ! $path ) 
        {
            return;
        }
        
        $path         = $this->adjustVideoPath( $path );
        $videoService = VideoService::make( $path );
        $resolution   = $videoService->resolution;
        $ratio        = $videoService->ratio;
        $duration     = $videoService->duration;

        $folderPath = FileService::make()->getFolderPath( $path );
        $imagePath  = $folderPath . DIRECTORY_SEPARATOR . now()->timestamp . '-FrameAt1sec.png';
        CaptureImage::dispatch( $path, $imagePath );

        $reducedPath = $folderPath .  DIRECTORY_SEPARATOR . now()->timestamp . '-'.$this->names[ $i ];
        $reducedPath = FileService::make()->replaceExtension( $reducedPath, 'mp4' );
        ConvertVideoForStreaming::dispatch( $reducedPath, $path );


        $wordsArray = explode( ',', $keyWords );
        array_push( $wordsArray, $resolution, $ratio, $videoName, $projectNumber, $projectName, $client, $dateCreated );
        $keyWords = implode( ', ', $wordsArray );

        Video::create( [
            'description'    => '',
            'title'          => $videoName,
            'duration'       => $duration,
            'key_words'      => $keyWords,
            'original_video' => $path,
            'reduced_video'  => $reducedPath,
            'image_display'  => $imagePath,
            'resolution'     => $resolution,
            'made_for'       => $client,
            'project_number' => strval( $projectNumber ),
            'ratio'          => $ratio,
        ]);
       
    }

    private function adjustVideoPath( $path )
    {
        $path = explode( '\\public\\/', $path );
        $path = array_pop( $path );
        $path = explode( '\\', $path );
        array_shift( $path );
        $path = implode( '/', $path );
        $path = '/' . $path;
        return $path;
    }

    public function startRow(): int
    {
        return 2;
    }
}

