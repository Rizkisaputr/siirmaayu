<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class Kecamatan extends Model
{
  use HasHashSlug;
  protected $table = 'kecamatan';
  protected $guarded = ['id'];

  public function kabupaten()
  {
      return $this->belongsTo(Kabupaten::class);
  }

  public function puskesmas()
  {
      return $this->hasMany(Puskesmas::class);
  }

}
