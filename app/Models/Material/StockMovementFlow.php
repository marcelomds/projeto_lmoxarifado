<?php

namespace App\Models\Material;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovementFlow extends Model
{
    use HasFactory;

    protected $table = 'stock_movement_flows';

    protected $fillable = [
        'collaborator_id',
        'material_id',
        'quantity',
        'date',
        'type',
    ];

    public function material(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

    public function collaborator(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
