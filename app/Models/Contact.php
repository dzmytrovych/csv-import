<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // allow mass assigment to all fields
    protected $fillable = ['team_id', 'name', 'phone', 'email', 'sticky_phone_number_id'];

    const CONTACT_COLUMNS = ['team_id', 'name', 'phone', 'email', 'sticky_phone_number_id'];

    public function custom_attribute()
    {
        return $this->hasOne(CustomAttribute::class);
    }
}
