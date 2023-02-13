<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class Pekerjaan extends Model
{
  use HasHashSlug;
  protected $table = 'pekerjaan';
  protected $guarded = ['id'];

}
