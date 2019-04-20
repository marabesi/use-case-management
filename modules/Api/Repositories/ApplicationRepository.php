<?php

namespace Modules\Api\Repositories;

class ApplicationRepository extends Repository
{

    /**
     * {@inheritdoc}
     */
    public function model()
    {
        return '\Modules\Api\Models\Application';
    }

    /**
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetchAll($limit, $sorting)
    {
        $data = $this->getModel()->select();

        foreach ($sorting as $field => $value) {
            $data->orderBy($field, $value);
        }

        return $data->paginate($limit);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetchAllWithOutPagination()
    {
        return $this->getModel()->get();
    }
}
