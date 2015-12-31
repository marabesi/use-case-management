<?php

namespace Modules\Api\Models;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{

    /**
     * @var string
     */
    protected $table = 'revisao';

    /**
     * @var string
     */
    protected $primaryKey = 'id_revisao';

    /**
     * @var boolean
     */
    public $timestamps = false;
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function useCase()
    {
        return $this->hasMany('Modules\Api\Models\UseCase', 'id_caso_de_uso');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function revisionActors()
    {
        return $this->hasMany('Modules\Api\Models\RevisionActors', 'id_dados_revisao');
    }
    
    /**
     * @param int $id
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function findByUseCase($id)
    {
        return $this->select('id_revisao', 'id_dados_revisao')
            ->from('revisao')
            ->where('id_caso_de_uso', $id);
    }

    /**
     * @param int $id
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function findByRevision($id)
    {
        return $this->select('id_revisao')
            ->from('revisao')
            ->where('id_dados_revisao', $id);
    }
}
