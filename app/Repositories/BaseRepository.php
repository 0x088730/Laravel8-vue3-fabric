<?php

namespace App\Repositories;

trait BaseRepository
{
    /**
     * Get model by id.
     *
     * @return App\Model
     */
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Get ids of records
     *
     * @return array
     */
    public function getIds()
    {
        return $this->model->select('id')->get()->map(function($item){
            return $item->id;
        })->toArray();
    }

    /**
     * Get number of records
     *
     * @return array
     */
    public function getCount()
    {
        return $this->model->count();
    }

    /**
     * Get all the records
     *
     * @return array User
     */
    public function all($orderBy = 'id', $dir = 'asc')
    {
        return $this->model->orderBy($orderBy, $dir)->get();
    }

    /**
     * Get number of the records
     *
     * @param  int $number
     * @param  string $sort
     * @param  string $sortColumn
     * @return Paginate
     */
    public function page($number = 10, $sort = 'desc', $sortColumn = 'created_at')
    {
        return $this->model->orderBy($sortColumn, $sort)->paginate($number);
    }

    /**
     * Store a new record.
     *
     * @param  $input
     * @return User
     */
    public function store($input)
    {
        return $this->save($this->model, $input);
    }

    /**
     * Update a record by id.
     *
     * @param  $id
     * @param  $input
     * @return User
     */
    public function update($id, $input)
    {
        $this->model = $this->getById($id);
        return $this->save($this->model, $input);
    }

    /**
     * Update columns in the record by id.
     *
     * @param $id
     * @param $input
     * @return App\Model|User
     */
    public function updateColumn($id, $input)
    {
        $this->model = $this->getById($id);

        foreach ($input as $key => $value) {
            $this->model->{$key} = $value;
        }

        return $this->model->save();
    }
    /**
     * Update Or Create columns in the record .
     *
     * @param $id
     * @param $input
     * @return App\Model
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        $class = get_class($this->model);

        return $class::updateOrCreate($attributes, $values);
    }

    /**
     * Save the input's data.
     *
     * @param  $model
     * @param  $input
     * @return User
     */
    public function save($model, $input)
    {
        $model->fill($input);
        $model->save();

        return $model;
    }

    /**
     * Destroy a model.
     *
     * @param  $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->getById($id)->delete();
    }
}
