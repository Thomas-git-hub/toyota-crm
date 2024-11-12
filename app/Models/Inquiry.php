<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inquiry extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'inquiry';

    protected $fillable = [
        'users_id',
        'customer_first_name',
        'customer_last_name',
        'contact_number',
        'unit',
        'variant',
        'color',
        'gender',
        'province_id',
        'transaction',
        'age',
        'source',
        'remarks',
        'date',
        'transactional_status',
        'updated_by'
    ];

    public function province(){
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
