<?php

namespace App\Http\Controllers;

use App\Models\TempFile;
use Illuminate\Http\Request;

class TempFileController extends Controller
{
    public function store(Request $request)
    {
        if (! $request->hasFile('video')) {
            return response(__('Video is required'), 400);
        }

        $file     = $request->file('video');
        $fileName = now()->timestamp . '-original-' .$file->getClientOriginalName();
        $folder   = uniqid() . '-' . now()->timestamp;
        $file->storeAs('tmp' . DIRECTORY_SEPARATOR . $folder, $fileName, 'backup');

        TempFile::create([
            'folder' => $folder,
            'filename' => $fileName
        ]);

        return response($folder, 200);
    }

    public function delete(Request $request)
    {
        $folder = $request->getContent();
        $temp = TempFile::where('folder', $folder)->first();

        $videosPath         =  public_path(DIRECTORY_SEPARATOR . 'videos');
        $tmpVideoFolderPath =  $videosPath.  DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR .$folder;
        unlink($tmpVideoFolderPath .  DIRECTORY_SEPARATOR . $temp->filename);
        rmdir($tmpVideoFolderPath);

        $temp->delete();
        return response($folder, 200);
    }
}
