<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
     protected $fillable = [
        'company_id','user_id','original_url','short_code','hits'
    ];

  

   public function user()
    {
        return $this->belongsTo(User::class);
    }




}
