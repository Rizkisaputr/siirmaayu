<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class Provinsi extends Model
{
  use HasHashSlug;
  protected $table = 'provinsi';
  protected $guarded = ['id'];

}
