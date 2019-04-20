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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function revision()
    {
        return $this->belongsTo('Modules\Api\Models\Revision', 'id_revisao');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function actor()
    {
        return $this->hasMany('Modules\Api\Models\Actor', 'id_actor');
    }
    
    /**
     * @param int $id
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function findByRevision($id)
    {
        return $this->select('id_relacionamento_dados_revisao')
                ->from('relacionamento_dados_revisao')
                ->where('id_revisao', $id);
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

    /**
     * @param $id
     * @return mixed
     */
    public function findActorByRevision($id)
    {
        return $this->select(
            'id_relacionamento_dados_revisao',
            'ator.id_ator',
            'nome',
            'descricao'
        )
            ->from('relacionamento_dados_revisao')
            ->join('ator', 'relacionamento_dados_revisao.id_ator', '=', 'ator.id_ator')
            ->where('relacionamento_dados_revisao.id_revisao', $id);
    }
}
