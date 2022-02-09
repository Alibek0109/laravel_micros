<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Main extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'mains';
    protected $fillable = ['id', 'type_id', 'category_id', 'date', 'sum', 'user_id', 'result', 'comment', 'created_at', 'updated_at', 'deleted_at'];

    public function categories() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}

