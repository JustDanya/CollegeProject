<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
	
	protected $fillable = ['title', 'user_id', 'photo'];
	

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
   /* public function toSearchableArray()
    {
        $array = $this->toArray();

        $array = ['title'];

        return $array;
    }*/

     public function photos()
    {
        return $this->hasMany('App\Models\Photos');
    }

}
