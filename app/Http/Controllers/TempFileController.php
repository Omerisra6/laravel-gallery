<?php

namespace App\Http\Controllers;

use App\Models\TempFile;
use Illuminate\Http\Request;

class TempFileController extends Controller
{
    public function store( Request $request )
    {
        if ( ! $request->hasFile( 'video' ) ) 
        {
            return response( __( 'Video is required' ), 400 );
        }
        
        $file     = $request->file('video');
        $fileName = now()->timestamp . '-original-' .$file->getClientOriginalName();
        $folder   = uniqid() . '-' . now()->timestamp;
        $file->storeAs( 'tmp/' . $folder, $fileName, 'backup' );

        TempFile::create([
            'folder' => $folder,
            'filename' => $fileName
        ]);

        return response( $folder, 200 );
    }

    public function delete(  $folder )
    {
        $temp = TempFile::findOrFail( $folder, 'folder' );

        unlink(  public_path( 'tmp/' .$folder . '/' . $temp->filename ) );
        rmdir(  public_path( 'tmp/' .$folder ) );
    }
}
