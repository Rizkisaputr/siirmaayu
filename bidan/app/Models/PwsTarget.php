<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class PwsTarget extends Model
{
  use HasHashSlug;
  protected $table = 'pws_target';
  protected $guarded = ['id'];

}
