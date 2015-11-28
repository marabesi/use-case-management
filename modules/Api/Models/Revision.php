<?php

namespace Modules\Api\Models;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    protected $table = 'revisao';
    protected $primaryKey = 'id_revisao';
    public $timestamps = false;

    /**
     * @param int $id
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function findByUseCase($id)
    {
        return $this->select('id_dados_revisao')
            ->from('revisao')
            ->where('id_caso_de_uso', $id);
    }
}
