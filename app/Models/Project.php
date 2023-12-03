<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    public function type(){
        //relaziione con la tabella Type
        //la funzione deve essere al singolare perchè il project ha un solo type
        //a questa funzione accederò come proprietà della classe Project
        return $this->belongsTo(Type::class);
    }

    protected $fillable =[
        'title',
        'type_id',
        'slug',
        'start_date',
        'end_date',
        'description',
        'url',
        'image',
        'image_original_name',
    ];

    public static function generateSlug($string){

        $slug =  Str::slug($string, '-');
        $original_slug = $slug;

        $exists = Project::where('slug', $slug)->first();
        $c = 1;

        while($exists){
            $slug = $original_slug. '-'. $c;
            $exists = Project::where('slug', $slug)->first();
            $c++;
        }
        return $slug;
    }
}
