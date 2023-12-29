<?php

namespace Ismail\CrudGenerator\Models;

use Illuminate\Database\Eloquent\Model;

class CrudModel extends Model
{
    protected $fillable = ['title', 'description'];
}