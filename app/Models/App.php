<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;

    protected $table = 'tbl_ap';

    //function buat relationship
    public function getPosition()
    {
        return $this->hasOne(Lookup::class, 'id', 'position_category_id');
    }
}
