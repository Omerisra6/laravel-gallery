<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoView extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'video_id',
        'user_id',
        'ip_address',
        'user_agent',
        'view_duration',
        'completed',
    ];

    /**
     * Get the video that owns the view.
     */
    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    /**
     * Get the user that owns the view.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}