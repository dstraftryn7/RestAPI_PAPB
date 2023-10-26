<?php

namespace App\Models;

use App\Models\Tasks;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Boards extends Model
{
    use HasFactory;

    protected $table = "boards";

    protected $fillable = [
        'nama',
        'user_id',
    ];
    protected $guarded = ['id', 'timestamp'];

    public function tasks(): HasMany
    {
        return $this->hasMany(Tasks::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
