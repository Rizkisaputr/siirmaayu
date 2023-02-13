<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class PersalinanMasa extends Model
{
  use HasHashSlug;
  protected $table = 'persalinan_masa';
  protected $guarded = ['id'];

  public function persalinan()
  {
      return $this->belongsTo(Persalinan::class);
  }

}
