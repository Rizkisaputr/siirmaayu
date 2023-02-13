<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class Persalinan extends Model
{
  use HasHashSlug;
  protected $table = 'persalinan';
  protected $guarded = ['id'];

  public function k1()
  {
      return $this->belongsTo(Periksa::class,'k1_id');
  }

  public function masa()
  {
      return $this->hasMany(PersalinanMasa::class);
  }
  public function data()
  {
      return $this->hasMany(PersalinanData::class);
  }

}
