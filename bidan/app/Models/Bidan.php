<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class Bidan extends Model
{
  use HasHashSlug;
  protected $table = 'bidan';
  protected $guarded = ['id'];

}
