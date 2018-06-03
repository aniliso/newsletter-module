<?php

namespace Modules\Newsletter\Entities;

use Illuminate\Database\Eloquent\Model;

class SubscriberTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'newsletter__subscriber_translations';
}
