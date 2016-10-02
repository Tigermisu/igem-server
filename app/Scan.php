<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scan extends Model
{
    /**
     * Get the records for the scan.
     */
    public function records()
    {
        return $this->hasMany('App\Record');
    }
}
