<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
class Article extends Model
{
      /**
       * The table associated with the model.
       *
       * @var string
       */
      protected $table = 'articles';
      use SoftDeletes;
      protected $fillable = ['name', 'description','price','total_in_shelf','total_in_vault','store_id'];


      /**
       * Get the store that owns the article.
       */
      public function store()
      {
          return $this->belongsTo('App\Store');
      }



}
