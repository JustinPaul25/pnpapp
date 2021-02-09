<?php

namespace App\Models;

use App\User;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class CaseReport extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = [];

    public function crime()
    {
        return $this->belongsTo(Crime::class);
    }

    public function prepared()
    {
        return $this->belongsTo(User::class, 'prepared_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('report-image')->singleFile();
        $this->addMediaCollection('report-video')->singleFile();
    }
}
