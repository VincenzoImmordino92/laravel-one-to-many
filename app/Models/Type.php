<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Type extends Model
{
    use HasFactory;

    public function projects(){
        //relazione con la tabella Project(creo una funzione con il nome della tabella )
        //ogni type fa tanti progetti, a questa funzione accederò come proprietà della classe Type
        return $this->hasMany(Project::class);
    }

    protected $fillable =[
        'name','slug'
    ];
}
