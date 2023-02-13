<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class Pws extends Model
{
  use HasHashSlug;
  protected $table = 'pws';
  protected $guarded = ['id'];

}
