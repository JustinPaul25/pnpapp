<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crime extends Model
{
    protected $guarded = [];

    public function caseReports()
    {
        return $this->hasMany(CaseReport::class);
    }
}
