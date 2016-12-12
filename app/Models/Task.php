<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    
	protected $fillable = ['label', 'project_id', 'group_id'];

}
