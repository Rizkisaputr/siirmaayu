<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class Kabupaten extends Model
{
  use HasHashSlug;
  protected $table = 'kabupaten';
  protected $guarded = ['id'];

  public function provinsi()
  {
      return $this->belongsTo(Provinsi::class);
  }

}
