<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class AssOption extends Model
{
    use HasHashSlug;
    
    protected $table = "ass_options";
    
    protected $guarded = [];
    
    public function item() {
        return $this->belongsTo('App\AssItem');
    }
    
    public function responses() {
        return $this->hasMany('App\AssResponse');
    }
}
