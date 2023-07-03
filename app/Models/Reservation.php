<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'reservations';

    public const TIME = [
        'morning'           => 'Morning',
        'afternoon'         => 'Afternoon',
        'evening'           => 'Evening',
    ];

    public const ROOM = [
        'standard'           => 'Standard',
        'deluxe'             => 'Deluxe',
        'suite'              => 'Suite',
    ];

    protected $dates = [
        'check_in_date',
        'check_out_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'zip_code',
        'city',
        'state',
        'email',
        'phone',
        'check_in_date',
        'check_out_date',
        'check_in_time',
        'check_out_time',
        'no_of_adults',
        'no_of_children',
        'no_of_rooms',
        'room_1_type',
        'room_2_type',
        'instructions',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
