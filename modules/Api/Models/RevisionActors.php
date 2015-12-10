<?php

namespace Modules\Api\Models;

use Illuminate\Database\Eloquent\Model;

class RevisionActors extends Model
{

    /**
     * @var string
     */
    protected $table      = 'relacionamento_dados_revisao';

    /**
     * @var string
     */
    protected $primaryKey = 'id_relacionamento_dados_revisao';

    /**
     * @var boolean
     */
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

    /**
     * @param int $id
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function findByActor($id)
    {
        return $this->select('id_relacionamento_dados_revisao')
            ->from('relacionamento_dados_revisao')
            ->where('id_ator', $id);
    }
}