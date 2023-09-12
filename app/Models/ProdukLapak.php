<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdukLapak extends Model
{
    use HasFactory;
    public function lapak(): BelongsTo
    {
        return $this->belongsTo(Lapak::class, 'id_lapak');
    }
}
