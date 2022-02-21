<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'imdb_id',
        'title',
        'year',
        'type',
        'poster_id'
    ];

     /**
     * Get the link of the poster.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function poster()
    {
        return $this->belongsTo(Poster::class);
    }

    public function delete()
    {
        $this->poster()->delete();
        return parent::delete();
    }
}
