<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Circuit extends Model
{
  protected $touches = ['panel'];

  protected $fillable = ['id', 'name', 'circuit_num', 'poles', 'user_id', 'job_id', 'panel_id', 'modified_by', 'ab'];

  public function panel() {
    return $this->belongsTo(Panel::class);
  }
}
