<?php

namespace Modules\Api\Models;

use Illuminate\Database\Eloquent\Model;

class RevisionActors extends Model
{
    protected $table      = 'relacionamento_dados_revisao';
    protected $primaryKey = 'id_relacionamento_dados_revisao';
    public $timestamps    = false;

    /**
     * @param int $id
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function findByRevision($id)
    {
        return $this->select('id_relacionamento_dados_revisao')
                ->from('relacionamento_dados_revisao')
                ->where('id_dados_revisao', $id);
    }
}