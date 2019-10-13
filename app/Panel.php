<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Panel extends Model
{
  protected $touches = ['job'];

  protected $fillable = ['name', 'info', 'circuit_count', 'comment', 'user_id', 'job_id', 'modified_by', 'ab'];

  public function circuits() {
    return $this->hasMany(Circuit::class)->orderBy('circuit_num');
  }
  public function job() {
    return $this->belongsTo(Job::class);
  }
}
