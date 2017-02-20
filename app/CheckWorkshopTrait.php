<?php

namespace App;

trait CheckWorkshopTrait {
	public function hasWorkshops() 
	{
    return $this->workshops()->count() > 0;
  }

  public function workshops()
  {
  	$fk = explode('\\', strtolower(get_class($this)))[1] . '_id';
  	return $this->hasMany(Workshop::class, $fk);
  }
}