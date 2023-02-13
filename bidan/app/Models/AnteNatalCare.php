<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class AnteNatalCare extends Model
{
  use HasHashSlug;
  protected $table = 'ante_natal_care';
  protected $guarded = ['id'];

  public function persalinan()
  {
      return $this->belongsTo(Persalinan::class);
  }

}
