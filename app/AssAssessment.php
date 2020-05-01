<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class AssAssessment extends Model
{
    use HasHashSlug;
    
    protected $table = "ass_assessments";
    
    protected $guarded = [];
    
    public function categories() {
        return $this->hasMany('App\AssCategory');
    }
    
    public function responders() {
        return $this->hasMany('App\AssResponder');
    }
}
