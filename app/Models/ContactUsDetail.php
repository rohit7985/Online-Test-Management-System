<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class ContactUsDetail extends Model
{
    protected $fillable = ['name', 'email', 'subject', 'message'];
}
