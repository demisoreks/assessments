<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class AssResponder extends Model
{
    use HasHashSlug;
    
    protected $table = "ass_responders";
    
    protected $guarded = [];
    
    public function assessment() {
        return $this->belongsTo('App\AssAssessment');
    }
    
    public function responses() {
        return $this->hasMany('App\AssResponse');
    }
}
