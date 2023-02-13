<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class Periksa extends Model
{
  use HasHashSlug;
  protected $table = 'k1';
  protected $guarded = ['id'];

  public function ibu()
  {
      return $this->belongsTo(Ibu::class,'ibu_id');
  }

  public function tm()
  {
      return $this->hasMany(Trimester::class,'k1_id');
  }

  public function persalinan()
  {
      return $this->hasMany(Persalinan::class,'k1_id');
  }

  public function kontrasepsi()
  {
      return $this->hasMany(Kontrasepsi::class,'k1_id');
  }

  public function pe()
  {
      return $this->hasMany(Pe::class,'k1_id');
  }

  public function postnatal()
  {
      return $this->hasMany(PostNatal::class,'k1_id');
  }

}
