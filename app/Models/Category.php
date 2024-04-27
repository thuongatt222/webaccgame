<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'categories';
    protected $fillable = ['title', 'description', 'image', 'status', 'order_category'];
    public function accessories(){
        return $this->belongsTo(Accessories::class);
    }
}
