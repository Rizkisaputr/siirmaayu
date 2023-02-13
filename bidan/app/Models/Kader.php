<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class Kader extends Model
{
  use HasHashSlug;
  protected $table = 'kader';
  protected $guarded = ['id'];

  public function desa()
  {
      return $this->belongsTo(Desa::class);
  }

}
