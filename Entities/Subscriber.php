<?php

namespace Modules\Newsletter\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use Translatable;

    protected $table = 'newsletter__subscribers';
    public $translatedAttributes = [];
    protected $fillable = [];
}
