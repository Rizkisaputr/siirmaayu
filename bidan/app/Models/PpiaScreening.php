<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class PpiaScreening extends Model
{
  use HasHashSlug;
  protected $table = 'ppia_screening';
  protected $guarded = ['id'];

  public function ppia()
  {
      return $this->belongsTo(Ppia::class);
  }

}
