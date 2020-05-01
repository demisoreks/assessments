<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class AssResponse extends Model
{
    use HasHashSlug;
    
    protected $table = "ass_responses";
    
    protected $guarded = [];
    
    public function responder() {
        return $this->belongsTo('App\AssResponder');
    }
    
    public function item() {
        return $this->belongsTo('App\AssItem');
    }
    
    public function option() {
        return $this->belongsTo('App\AssOption');
    }
}
