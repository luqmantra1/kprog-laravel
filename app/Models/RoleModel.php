<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    use HasFactory;

    protected $table = 'role'; // double-check your table name here (is it role or roles?)

    protected $fillable = ['name'];

    static public function getRecord(){
        return self::all();
    }

    static public function getSingle($id){
        return self::find($id);
    }
}


