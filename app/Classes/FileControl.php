<?php


namespace App\Classes;


use Illuminate\Support\Facades\Request;

class FileControl
{
    public static function FileSave($name){
        $dir = "public/".$name;
        $newName = $name."_".uniqid().".".request()->file($name)->extension();
        request()->file($name)->storeAs($dir,$newName);
        return $newName;
    }
}
