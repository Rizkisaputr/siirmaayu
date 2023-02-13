<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class Puskesmas extends Model
{
  use HasHashSlug;
  protected $table = 'puskesmas';
  protected $guarded = ['id'];

  public function kecamatan()
  {
      return $this->belongsTo(Kecamatan::class);
  }

}
