<?php

namespace App\Models;

use App\Models\Boards;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tasks extends Model
{
    use HasFactory;

    protected $table = "tasks";

    protected $fillable = [
        'title',
        'description',
        'status'
    ];
    protected $guarded = ['id', 'timestamp'];

    public function board(): BelongsTo
    {
        return $this->belongsTo(Boards::class);
    }
}
