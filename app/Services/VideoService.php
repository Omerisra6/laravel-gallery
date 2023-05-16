<?php
namespace App\Services;

use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class VideoService{

    public $video;
    public $duration;
    public $resolution;
    public $ratio;
    
    private function __construct( $path, $disk )
    {
        $this->video      = FFMpeg::fromDisk( $disk )->open( $path );
        $this->duration   = $this->getDuration();
        $this->resolution = $this->getResolution();
        $this->ratio      = $this->getRatio();
    }

    public static function make( $path, $disk = 'backup' )
    {
        return new static( $path, $disk );
    }
    
    public function getDuration( )
    {
        $durationInSeconds = $this->video->getDurationInSeconds();
        $minutes = ( int ) ( $durationInSeconds / 60 );
        if ( $minutes < 10 ) 
        {
            $minutes = '0'. $minutes;
        }

        $seconds = $durationInSeconds - ( $minutes * 60 );

        if ( $seconds < 10 ) 
        {
            $seconds = '0'. $seconds;
        }
        
        return  $minutes . ':' . $seconds;
    }

    public function getResolution()
    {

        $width = $this->video
        ->getVideoStream()
        ->getDimensions()
        ->getWidth();

        $height = $this->video
        ->getVideoStream()
        ->getDimensions()
        ->getHeight();
       
        return $width.' X '.$height;
    }

    public function getRatio( )
    {   
        $resArray = explode( 'X', $this->resolution );

        $width  = intval( $resArray[ 0 ] );
        $height = intval( $resArray[ 1 ] );

        $gcd = function ( $a, $b ) use ( &$gcd ) { return $b ? $gcd( $b, $a % $b ) : $a; };
        $divisor = intval( $gcd($width, $height) ); 

        return $width / $divisor . 'X' . $height / $divisor;
    }

}