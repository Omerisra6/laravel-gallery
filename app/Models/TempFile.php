<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TempFile extends Model
{
    use HasFactory;

    protected $fillable = ['folder', 'filename'];

    public function getPathAttribute()
    {
        return 'tmp' . DIRECTORY_SEPARATOR . $this->folder .DIRECTORY_SEPARATOR . $this->filename;
    }

    public function moveAndDelete($newPath)
    {
        Storage::disk('backup')->move($this->path, $newPath);
        Storage::disk('backup')->deleteDirectory('tmp' . DIRECTORY_SEPARATOR . $this->folder);
        $this->delete();
    }
}
