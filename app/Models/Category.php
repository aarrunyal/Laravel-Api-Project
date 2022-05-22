<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $uploadPath = "uploads/category";


    public $fillable=[
        "title", 'description', "is_active", "image"
    ];

    protected $appends=[
        "image_path"
    ];

    public function getImagePathAttribute(){
        if(!empty($this->image)){
            return asset($this->uploadPath."/".$this->image);
        }
    }
}
