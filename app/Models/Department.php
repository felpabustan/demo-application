<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    
    public $guarded = [];
    
    public function user(){
        return $this->hasOne(User::class , 'user_id');
    }
    
    public function employee()
    {
        return $this->hasOne(Employee::class, 'employee_id');
    }
}
