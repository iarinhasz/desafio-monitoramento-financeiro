<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable =[
        'cpf', 'name', 'data_nascimento', 'email', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    //relacionando transcaoes
    public function transactions(){
        return $this->hasMany(Transaction::class, 'usuario_id');
    }

    public static $rules = [
        'email' => 'unique:users,email',
        'cpf' => 'unique:users, cpf'
    ];
}
