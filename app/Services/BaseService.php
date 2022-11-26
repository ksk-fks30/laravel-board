<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseService
{
    protected string $model;

    /**
     * IDから取得して返す
     *
     * @param $id
     * @param array $with
     * @return Model|null
     */
    public function find($id, array $with=[]): ?Model
    {
        return $this->query()
            ->where('id', $id)
            ->with($with)
            ->first();
    }

    /**
     * 全件取得する
     *
     * @param array $with
     * @return Collection
     */
    public function getAll(array $with=[]): Collection
    {
        return $this->query()
            ->with($with)
            ->get();
    }

    /**
     * 新規登録する
     *
     * @param $params
     * @return Model
     */
    public function create($params): Model
    {
        $model = new $this->model();

        $model->fill($params)->save();

        return $model;
    }

    /**
     * 更新する
     *
     * @param $model
     * @param $params
     * @return Model|null
     */
    public function update($model, $params): ?Model
    {
        if ($model === null) {
            return null;
        }

        $model->fill($params)->save();

        return $model;
    }

    /**
     * モデルのquery()を返す
     *
     * @return string
     */
    protected function query()
    {
        return $this->model::query();
    }
}
