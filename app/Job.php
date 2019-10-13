<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
  protected $fillable = [
    'name',
    'comment',
    'user_id',
    'modified_by',
  ];

  public function panels() {
    return $this->hasMany(Panel::class)->orderBy('name');
  }
  public function recentPanels() {
    // return $this->hasMany(Panel::class);
    return $this->hasMany(Panel::class)->latest('updated_at')->take(5);
    // return $recent_panel;
  }

  // public function org() {
  //   return $this->belongsTo(Org::class);
  // }
  public function job() {
    return $this->belongsTo(User::class);
  }
}
