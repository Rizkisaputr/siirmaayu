<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class Ibu extends Model
{
  use HasHashSlug;
  protected $table = 'ibu';
  protected $guarded = ['id'];

  public function puskesmas()
  {
      return $this->belongsTo(Puskesmas::class);
  }

  public function posyandu()
  {
      return $this->belongsTo(Posyandu::class);
  }

  public function bidan()
  {
      return $this->belongsTo(Bidan::class);
  }

  public function kader()
  {
      return $this->belongsTo(Kader::class);
  }

  public function pekerjaan()
  {
      return $this->belongsTo(Pekerjaan::class);
  }

  public function pendidikan()
  {
      return $this->belongsTo(Pendidikan::class);
  }

  public function periksa()
  {
      return $this->hasMany(Periksa::class);
  }

}
