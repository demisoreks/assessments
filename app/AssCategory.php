<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class AssCategory extends Model
{
    use HasHashSlug;
    
    protected $table = "ass_categories";
    
    protected $guarded = [];
    
    public function assessment() {
        return $this->belongsTo('App\AssAssessment');
    }
    
    public function items() {
        return $this->hasMany('App\AssItem');
    }
}
