<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class Kontrasepsi extends Model
{
  use HasHashSlug;
  protected $table = 'kontrasepsi';
  protected $guarded = ['id'];

  public function k1()
  {
      return $this->belongsTo(Periksa::class,'k1_id');
  }

}
