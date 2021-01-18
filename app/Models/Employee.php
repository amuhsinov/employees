<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
		'first_name', 
		'last_name',
		'address',
		'phone',
		'department_id',
		'position_id',
		'salary',
	];

	public function department() {
		return $this->belongsTo(Department::class);
	}

	public function position() {
		return $this->belongsTo(Position::class);
	}
}
