<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;
    protected  $fillable = ["title","tags", "email" ,"company","website","description","location","city","logo","user_id"];

    public function scopeFilter($query, array $filters){
        if(isset($filters["tag"]) != false){
            $query->where("tags", "like", "%" . request("tag") . "%" );
        }
        if(isset($filters["search"]) != false){
            $query->where("company", "like", "%" . request("search") . "%" )
            ->orwhere("title", "like", "%" . request("search") . "%" )
            ->orwhere("company", "like", "%" . request("search") . "%" )
            ->orwhere("tags", "like", "%" . request("search") . "%" );
          
        }        
    }

    // relationship to User
    public function users(){
        return  $this -> belongsTo(User::class, "user_id") ;
    }
}
