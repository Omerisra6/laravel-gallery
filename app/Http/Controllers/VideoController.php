<?php

namespace App\Http\Controllers;

use App\Jobs\CaptureImage;
use App\Jobs\ConvertVideoForStreaming;
use App\Models\TempFile;
use App\Models\Video;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVideoRequest;
use App\Imports\IdImport;
use App\Imports\VideoImport;
use App\Services\DriveService;
use App\Services\FileService;
use App\Services\VideoService as ServicesVideoService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class VideoController extends Controller
{
    /**
     * Create a new controller instance.
     * 
     * @return void
    */
    public function show( $id )
    {
        $video = Video::findOrFail( $id );
        return view('showVideo')->with('video', $video);
    }

    /**
     * Create a new controller instance.
     * 
     * @return void
    */
    public function storeVideos( StoreVideoRequest $request )
    {
        $request->validated();

        $errors = collect( $request->videos )->map( function( $video ) {

            $this->storeVideo( $video ) ? 
            null :
            [ $video[ 'title' ] => __( 'Video upload failed' ) ] ;
        })
        ->filter();   

        if ( $errors->count() > 0 ) 
        {
            return response( $errors, 400 );
        }
        
        return response( __( 'All videos uploaded' ), 200 );
    }

    /**
     * Download original video
     * 
     * @return void
    */
    public function downloadOriginal( $id )
    {
        $video           = Video::findOrFail( $id );
        $path            = $video->original_video;
        $path            = explode('.', $path);
        $extension       = array_pop($path);

        $videoPublicName = $video->title.'-original'.'.'.$extension;
        $videoPublicPath = public_path( 'videos/'.$video->original_video );

        return response()->download( $videoPublicPath , $videoPublicName );
    } 

    /**
     * Download reduced video
     * 
     * @return void
    */
    public function downloadReduced( $id )
    {
        $video           = Video::findOrFail( $id );

        $videoPublicName = $video->title.'-reduced.mp4';
        $videpPublicPath = public_path( 'videos/'. $video->reduced_video );

        return response()->download( $videpPublicPath , $videoPublicName );
    }

    /**
     * Search video
     * 
     * @return void
    */
    public function search( $value )
    {
        $videos = Video::where( 'key_words', 'like', '%'.$value.'%' )
        ->orWhere( 'description', 'LIKE', '%'.$value.'%' )
        ->orWhere( 'resolution', 'LIKE', '%'.$value.'%' )
        ->orWhere( 'project_number', 'LIKE', '%'.$value.'%' )
        ->orWhere( 'ratio', 'LIKE', '%'.$value.'%' )
        ->orWhere( 'title', 'LIKE', '%'.$value.'%' )
        ->orderBy( 'created_at' ,'DESC' )
        ->latest()
        ->paginate( 12 );
            
        return view('welcome')->with( 'videos', $videos );
    }

    /**
     * Import videos from google drive
     * 
     * @return void
    */
    public function importVideos( Request $request )
    {
        $file  = $request->file( 'file' );
        $idImport = new IdImport();
        Excel::import( $idImport, $file );
        $ids = $idImport->ids;
        
        
        $driveNames = DriveService::getFileNames( $ids );
        $names      = $driveNames[ 'names' ];
        $errors     = $driveNames[ 'errors' ];
        
        Excel::import( new VideoImport( $names ), $file );

        if( $errors->count() > 0 )
        {
            return response( $errors, 400 );
        }

        return response( 'All videos uploaded', 200 );
    }


    /**
     * Store video in DB with all relevant attributes`
     * 
     * @return void
    */
    private function storeVideo( $video )
    {
        $tempFile = TempFile::where( 'folder', $video[ 'video' ] )->first();

        if( ! $tempFile ) 
        {
            return false;
        }

        $projectNum = $video['project_number'];
        $madeFor    = $video['made_for'];

        $fileName   = $tempFile->filename;
        $tmpPath    = $tempFile->path;

        $videoService = ServicesVideoService::make( $tmpPath );
        $resolution   = $videoService->resolution;
        $duration     = $videoService->duration;
        $ratio        = $videoService->ratio;
        $fileRatio    = str_replace( ':', 'X', $ratio );

        $basePath         = '/videos/'. $madeFor . '/' . $projectNum . '/' . $fileRatio . '/';
        $originalFilePath = $basePath . $fileName;
        $tempFile->moveAndDelete( $originalFilePath );        


        $reducedFilePath = str_replace( 'original', 'reduced', $fileName );
        $reducedFilePath = FileService::make()->replaceExtension( $reducedFilePath, 'mp4' );
        $reducedFilePath = $basePath . $reducedFilePath;
            
        ConvertVideoForStreaming::dispatch( $reducedFilePath, $originalFilePath );
        
        $imagePath = $basePath . now()->timestamp . '-FrameAt1sec.png';
        CaptureImage::dispatch( $originalFilePath, $imagePath );

        Video::create([
            'description'    => $video['description'],
            'title'          => $video['title'],
            'duration'       => $duration,
            'key_words'      => $video['key_words'],
            'original_video' => $originalFilePath,
            'reduced_video'  => $reducedFilePath,
            'image_display'  => $imagePath,
            'resolution'     => $resolution,
            'made_for'       => $madeFor,
            'project_number' => $projectNum,
            'ratio'          => $ratio,
        ]);

        return true;
    }


}