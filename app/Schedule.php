<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'schedules';

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Fillable
     *
     * @var array
     */
    protected $fillable = [
        'day_int',
        'day_string',
        'start',
        'end'
    ];
}
