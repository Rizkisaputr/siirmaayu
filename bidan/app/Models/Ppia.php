<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class Ppia extends Model
{
  use HasHashSlug;
  protected $table = 'ppia';
  protected $guarded = ['id'];

  public function k1()
  {
      return $this->belongsTo(Periksa::class,'k1_id');
  }

}
