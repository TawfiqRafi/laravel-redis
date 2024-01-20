<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'name', 'birthday', 'phone', 'ip', 'country'];

    protected $casts = [
        'birthday' => 'date:Y-m-d',
    ];

    // Additional attributes for easy querying
    protected $appends = ['birth_year', 'birth_month'];

    public function getBirthYearAttribute()
    {
        return optional($this->birthday)->format('Y');
    }

    public function getBirthMonthAttribute()
    {
        return optional($this->birthday)->format('m');
    }
}
