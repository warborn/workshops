<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    public $incrementing = false;
    
    use CheckWorkshopTrait;
}
