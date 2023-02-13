<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class Desa extends Model
{
  use HasHashSlug;
  protected $table = 'desa';
  protected $guarded = ['id'];

  public function kecamatan()
  {
      return $this->belongsTo(Kecamatan::class);
  }

}
