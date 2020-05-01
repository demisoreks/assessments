<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class AssItem extends Model
{
    use HasHashSlug;
    
    protected $table = "ass_items";
    
    protected $guarded = [];
    
    public function category() {
        return $this->belongsTo('App\AssCategory');
    }
    
    public function options() {
        return $this->hasMany('App\AssOption');
    }
    
    public function responses() {
        return $this->hasMany('App\AssResponse');
    }
}
