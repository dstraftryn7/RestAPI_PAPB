<?php

namespace App\Models;

use App\Models\Tasks;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Boards extends Model
{
    use HasFactory;

    protected $table = "boards";

    protected $fillable = [
        'nama',
    ];
    protected $guarded = ['id', 'timestamp'];

    public function task(): HasMany
    {
        return $this->hasMany(Tasks::class);
    }
}
