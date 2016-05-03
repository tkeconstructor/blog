<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = ['name', 'questiontext','shuffle','type_id','category_id','createdby','modifiedby'];

    
}
