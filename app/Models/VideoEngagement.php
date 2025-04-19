<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoEngagement extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'video_id',
        'user_id',
        'type',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'video_id' => 'integer',
        'user_id' => 'integer',
    ];

    /**
     * Get the video that the engagement belongs to.
     */
    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    /**
     * Get the user that made the engagement.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}