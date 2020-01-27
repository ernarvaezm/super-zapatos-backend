<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Store extends Model
{
      /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'stores';
    protected $fillable = ['name', 'address'];

    use SoftDeletes;

    /**
     * Get the articles for the store.
     */
    public function comments()
    {
        return $this->hasMany('App\Article');
    }

}
