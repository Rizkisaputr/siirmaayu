<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class Pendidikan extends Model
{
  use HasHashSlug;
  protected $table = 'pendidikan';
  protected $guarded = ['id'];

}
