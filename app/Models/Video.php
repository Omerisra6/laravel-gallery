<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var string[]
    */

    protected $timeStamps = true;

    protected $guarded = [];

    protected $fillable = [
        'title',
        'original_video',
        'reduced_video',
        'image_display',
        'duration',
        'made_for',
        'description',
        'project_number',
        'key_words',
        'resolution',
        'ratio',
    ];


}
