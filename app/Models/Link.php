<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Link
 * @package App\Models
 * @property int $id
 * @property string $short
 * @property string $created_at
 * @property Stat[] $stats
 */
class Link extends Model
{
    const UPDATED_AT = null;

    protected $fillable = ['link', 'short'];

    protected $visible = ['link', 'short'];

    /**
     * Get statistics for the link.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stats()
    {
        return $this->hasMany(Stat::class);
    }
}