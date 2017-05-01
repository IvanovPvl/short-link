<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Link
 * @package App\Models
 */
class Link extends Model
{
    protected $fillable = ['link', 'short'];

    protected $visible = ['link', 'short'];
}