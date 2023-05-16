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
        return 'tmp/'.$this->folder.'/'.$this->filename;
    }

    public function moveAndDelete( $newPath )
    {
        Storage::disk( 'backup' )->move( $this->path, $newPath );
        Storage::disk( 'backup' )->deleteDirectory( 'tmp/' . $this->folder );
        $this->delete();          
    }
}
