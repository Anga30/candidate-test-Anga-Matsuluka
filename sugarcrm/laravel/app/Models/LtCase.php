<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LtCase extends Model
{
    use HasFactory;

    /**
     * Resolve a case by ID.
     *
     * @param int $id The ID of the case.
     * @return LtCase|null The resolved case or null if not found.
     */
    public static function resolve($id)
    {
        return static::find($id);
    }
}
