<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Profile extends Model{

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function followers(){
        return $this->belongsToMany(User::class);
    }

    public function profileImage(){
        $imagePath = ($this->image) ? $this->image : 'profile/RAKBbDSTRfSSjsd1lzuWYMFk3uGFHEMxzuPJT75K.png';
        return (substr($imagePath,0,4)=="http") ? $imagePath : ('/storage/' . $imagePath);
    }
}
