<?php

namespace App\Repositories;

use App\Models\Item;
use App\Repositories\BaseRepository;

class ItemRepository
{
    use BaseRepository;

    /**
     * @var Model
     */
    protected $model;

    /**
     * Constructor
     *
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->model = $item;
    }

    /**
     * Get number of the records
     *
     * @param  Request $request
     * @param  int $number
     * @param  string $sort
     * @param  string $sortColumn
     * @return Paginate
     */
    public function pageWithRequest($request, $number = 12, $sort = 'desc', $sortColumn = 'created_at')
    {
        if ($request->has('limit')) {
            $number = $request->get('limit');
        }

        return $this->model->with('poster')
                ->orderBy($sortColumn, $sort)
                ->get();
    }

    public function store($item)
    {
        $model = new Item;
        $model->fill($item);
        $model->save();

        return $model;
    }

    public function destroyByImdbId($imdbId)
    {
        $item = $this->model->where('imdb_id', $imdbId)->first();
        if ($item)
        {
            return $item->delete();
        }else {
            return false;
        }
    }

}
