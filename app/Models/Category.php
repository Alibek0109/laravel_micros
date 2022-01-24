<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['id', 'type_id', 'title', 'created_at', 'updated_at'];

    public function main() {
        return $this->belongsTo(Main::class, 'category_id', 'id');
    }
}
