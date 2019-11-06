<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * This allows which column/fields can be saved, otherwise you will get an error
     * The opposite of "fillable" method is "guarded" which should be used if you have
     * alot of fields to save
     *
     * */
    protected $fillable = ['title', 'body', 'user_id'];

    /** Defines one to many relationship between blog and comments */
    public function comments()
    {

        /**
         * AppComment::class returns the full sting represenation of the class path
         * which is like having $this->hasMany('\App\Comment') but the below is better approach
         */
        /**instead of return $this->hasMany('\App\Comment'); we use below statement for better standards */
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function createComment($body)
    {
        /** Old approach
        Comment::create([
           'body' => request('commentBody'),
           'post_id' => $this->id
        ]);
        */

       /**
        * New Approach, since we have a relationship, we do not need to pass post_ID to Comments
        * Instead, we use eloquent to create comment
        */
        $this->comments()->create([
            'body' => $body,
            'user_id' => \Auth::user()->id
        ]);
    }
}
