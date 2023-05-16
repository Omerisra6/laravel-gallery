<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Video implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes( $attribute, $value )
    {
        $videoMimeTypes = [ 'mp4','mov','ogg','qt' ];
        $fileMime       = $value->getClientMimeType();

        if ( ! in_array( $fileMime, $videoMimeTypes ) ) 
        {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'File must be a video.';
    }
}
