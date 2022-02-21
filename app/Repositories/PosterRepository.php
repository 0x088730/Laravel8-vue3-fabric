<?php

namespace App\Repositories;

use App\Models\Poster;
use App\Repositories\BaseRepository;

class PosterRepository
{
    use BaseRepository;

    /**
     * @var Model
     */
    protected $model;

    /**
     * Constructor
     *
     * @param Poster $poster
     */
    public function __construct(Poster $poster)
    {
        $this->model = $poster;
    }

    public function store($poster) {

        $model = new Poster;
        $model->fill($poster);
        $model->save();

        return $model->id;
    }
}
