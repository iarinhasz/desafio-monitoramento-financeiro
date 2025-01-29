<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo', 'valor', 'categoria_id', 'usuario_id'
    ];
    //transacao -> categoria
    //transacao -> usuario
    public function category(){
        return $this->belongsTo(Category::class, 'categoria_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'usuario_id');
    }

}
