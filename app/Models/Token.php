<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    protected $table = "tokens";

    protected $fillable =[
        'token',
        'type',
        'client_id'
    ];


    public function client(){
        return $this->belongsTo(Client::class);
    }
}
