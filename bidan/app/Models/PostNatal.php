<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class PostNatal extends Model
{
  use HasHashSlug;
  protected $table = 'post_natal';
  protected $guarded = ['id'];

  public function periksa()
  {
      return $this->belongsTo(Periksa::class,'k1_id');
  }

}
