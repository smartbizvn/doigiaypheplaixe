<?php namespace App\Repositories;

interface RepositoryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id);

    public function findOrFail($id);

    public function with($relations);

    public function load($relations);

    public function whereNull($key);

    public function where($key, $val);

    public function whereIn($key, $val);

    public function query();

    public function orderBy($query, $orderBy = ['id' => 'asc']);

    public function paginate($query, array $columns = ['*'], array $with = []);

    public function filter($query, $params, $filterClass);

    public function bulkDelete(array $ids);

    public function insertGetId(array $data);

    public function updateOrCreate(array $params, array $data);
}