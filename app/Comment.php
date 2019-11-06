<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * This allows which column/fields can be saved, otherwise you will get an error
     * The opposite of "fillable" method is "guarded" which should be used if you have
     * alot of fields to save
     *
     * */
    protected $fillable = ['body', 'post_id', 'user_id'];

    public function post()
    {
        /**
         * App\Post::class returns the full sting represenation of the class path
         * which is like having $this->hasMany('\App\Post') but the below is better approach
         */
        /**instead of return $this->hasMany('\App\Post'); we use below statement for better standards */
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
