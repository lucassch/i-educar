<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LegacyDisciplineScore extends Model
{
    /**
     * @var string
     */
    protected $table = 'modules.nota_componente_curricular';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = [
        'nota_aluno_id',
        'componente_curricular_id',
        'nota',
        'nota_arredondada',
        'etapa',
        'nota_recuperacao',
        'nota_original',
        'nota_recuperacao_especifica'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function registrationScore()
    {
        return $this->belongsTo(LegacyRegistrationScore::class, 'nota_aluno_id');
    }

    public function discipline(): BelongsTo
    {
        return $this->belongsTo(LegacyDiscipline::class, 'componente_curricular_id');
    }

    public function score(int $decimalPlaces = 1): string|null
    {
        $score = $this->nota_arredondada;
        if (!is_numeric($score) || empty($score)) {
            return $score;
        }

        return str_replace('.', ',', bcdiv($score, 1, $decimalPlaces));
    }
}
