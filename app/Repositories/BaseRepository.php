<?php namespace App\Repositories;

use App\Repositories\RepositoryInterface;

class BaseRepository implements RepositoryInterface
{
  
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        $data = $this->model->create($data);
        return $data->fresh();
    }

    public function update(array $data, $id)
    {
        $model = $this->model->find($id);
        $model->update($data);
        return $model->fresh();
    }

    public function delete($id)
    {
        $this->model->destroy($id);
        return $this->model->fresh();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function load($relations)
    {
        return $this->model->load($relations);
    }

    public function whereNull($key)
    {
        return $this->model->whereNull($key);
    }

    public function where($key, $val)
    {
        return $this->model->where($key, $val);
    }
    
    public function whereIn($key, $val)
    {
        return $this->model->whereIn($key, $val);
    }

    public function insertGetId(array $data)
    {
        return $this->model->insertGetId($data);
    }

    public function bulkDelete($ids = [])
    {
        $this->model->query()->whereIn('id', $ids)->delete();
        return $this->model->fresh();
    }

    public function updateOrCreate(array $params, array $data)
    {
        return $this->model->updateOrCreate($params, $data);
    }
    
    public function query()
    {
        return $this->model->query();
    }
    
    public function orderBy($query, $orderBy = array('id' => 'asc'))
    {
        if(!empty($orderBy)){
            foreach ($orderBy as $column => $direction) {
                $query->orderBy($column, $direction);
            }
        }
    }

    public function paginate($query, $columns = ['*'], $with = [])
    {
        $perPage = request()->input('per_page') ?? 15;
        $page = request()->input('page') ?? 1;
        return $query->paginate($perPage, $columns, 'page', $page);
    }

    public function filter($query, $params, $filterClass)
    {
        $request = new \Illuminate\Http\Request($params);
        $filter = new $filterClass($request);
        return $filter->apply($query);
    }

    public function with($relations)
    {
        return $this->model->with($relations);
    }
}
