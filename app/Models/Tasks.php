<?php

namespace App\Models;

use App\Models\Boards;
use App\Models\User;
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
        'status',
        'boards_id',
        'user_id'
    ];
    protected $guarded = ['id', 'timestamp'];

    public function boards(): BelongsTo
    {
        return $this->belongsTo(Boards::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
}
