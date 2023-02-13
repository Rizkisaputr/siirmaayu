<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class Posyandu extends Model
{
  use HasHashSlug;
  protected $table = 'posyandu';
  protected $guarded = ['id'];

  public function desa()
  {
      return $this->belongsTo(Desa::class);
  }

}
