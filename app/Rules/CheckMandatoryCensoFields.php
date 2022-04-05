<?php

namespace App\Rules;

use App\Models\LegacyCourse;
use App\Models\LegacyInstitution;
use App\Models\School;
use App_Model_LocalFuncionamentoDiferenciado;
use App_Model_TipoMediacaoDidaticoPedagogico;
use iEducar\Modules\Educacenso\Model\TipoAtendimentoTurma;
use Illuminate\Contracts\Validation\Rule;

class CheckMandatoryCensoFields implements Rule
{
    public const ETAPAS_ENSINO_REGULAR = [
        1,
        2,
        3,
        14,
        15,
        16,
        17,
        18,
        19,
        20,
        21,
        22,
        23,
        25,
        26,
        27,
        28,
        29,
        35,
        36,
        37,
        38,
        41,
        56
    ];

    public const ETAPAS_ESPECIAL_SUBSTITUTIVAS = [
        1,
        2,
        3,
        14,
        15,
        16,
        17,
        18,
        19,
        20,
        21,
        22,
        23,
        25,
        26,
        27,
        28,
        29,
        30,
        31,
        32,
        33,
        34,
        35,
        36,
        37,
        38,
        41,
        56,
        39,
        40,
        69,
        70,
        71,
        72,
        73,
        74,
        64,
        67,
        68
    ];

    public $message = '';

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $params
     *
     * @return bool
     */
    public function passes($attribute, $params)
    {
        if ($this->validarCamposObrigatoriosCenso($params->ref_cod_instituicao)) {
            if (!$this->validaCamposHorario($params)) {
                return false;
            }
            if (!$this->validaEtapaEducacenso($params)) {
                return false;
            }
            if (!$this->validaCampoAtividadesComplementares($params)) {
                return false;
            }
            if (!$this->validaCampoEstruturaCurricular($params)) {
                return false;
            }
            if (!$this->validaCampoEtapaEnsino($params['tipo_atendimento'])) {
                return false;
            }
            if (!$this->validaCampoFormasOrganizacaoTurma($params)) {
                return false;
            }
            if (!$this->validaCampoTipoAtendimento($params)) {
                return false;
            }
            if (!$this->validaCampoLocalFuncionamentoDiferenciado($params)) {
                return false;
            }
        }

        return true;
    }

    protected function validarCamposObrigatoriosCenso($refCodInstituicao)
    {
        return (new LegacyInstitution())::query()
            ->find(['cod_instituicao' => $refCodInstituicao])
            ->first()
            ->isMandatoryCensoFields();
    }

    protected function validaCamposHorario($params)
    {
        if ($params->tipo_mediacao_didatico_pedagogico == App_Model_TipoMediacaoDidaticoPedagogico::PRESENCIAL) {
            if (empty($params->hora_inicial)) {
                $this->message = 'O campo hora inicial é obrigatório';

                return false;
            }
            if (empty($params->hora_final)) {
                $this->message = 'O campo hora final é obrigatório';

                return false;
            }
            if (empty($params->hora_inicio_intervalo)) {
                $this->message = 'O campo hora início intervalo é obrigatório';

                return false;
            }
            if (empty($params->hora_fim_intervalo)) {
                $this->message = 'O campo hora fim intervalo é obrigatório';

                return false;
            }
            if (empty($params->dias_semana)) {
                $this->message = 'O campo dias da semana é obrigatório';

                return false;
            }
        }

        return true;
    }

    private function validaEtapaEducacenso($params)
    {
        $course = LegacyCourse::find($params->ref_cod_curso);
        if ($params->tipo_atendimento == TipoAtendimentoTurma::ESCOLARIZACAO) {
            if ($course->modalidade_curso == 1 && !in_array(
                $params->etapa_educacenso,
                self::ETAPAS_ENSINO_REGULAR
            )) {
                $this->message = 'Quando a modalidade do curso é: Ensino regular, o campo: Etapa de ensino deve ser uma das seguintes opções:'
                    . implode(',', self::ETAPAS_ENSINO_REGULAR) . '.';

                return false;
            }

            if ($course->modalidade_curso == 2 && !in_array(
                $params->etapa_educacenso,
                self::ETAPAS_ESPECIAL_SUBSTITUTIVAS
            )) {
                $this->message = 'Quando a modalidade do curso é: Educação especial, o campo: Etapa de ensino deve ser uma das seguintes opções:'
                    . implode(',', self::ETAPAS_ESPECIAL_SUBSTITUTIVAS) . '.';

                return false;
            }

            if ($course->modalidade_curso == 3 && !in_array($params->etapa_educacenso, [69, 70, 71, 72])) {
                $this->message = 'Quando a modalidade do curso é: Educação de Jovens e Adultos (EJA), o campo: Etapa de ensino deve ser uma das seguintes opções: 69, 70, 71 ou 72.';

                return false;
            }

            if ($course->modalidade_curso == 4 && !in_array(
                $params->etapa_educacenso,
                [30, 31, 32, 33, 34, 39, 40, 73, 74, 64, 67, 68]
            )) {
                $this->message = 'Quando a modalidade do curso é: Educação Profissional, o campo: Etapa de ensino deve ser uma das seguintes opções: 30, 31, 32, 33, 34, 39, 40, 73, 74, 64, 67 ou 68.';

                return false;
            }

            if ($params->tipo_mediacao_didatico_pedagogico == App_Model_TipoMediacaoDidaticoPedagogico::SEMIPRESENCIAL
                && !in_array($params->etapa_educacenso, [69, 70, 71, 72])) {
                $this->message = 'Quando o campo: Tipo de mediação didático-pedagógica é: Semipresencial, o campo: Etapa de ensino deve ser uma das seguintes opções: 69, 70, 71 ou 72.';

                return false;
            }

            if ($params->tipo_mediacao_didatico_pedagogico == App_Model_TipoMediacaoDidaticoPedagogico::EDUCACAO_A_DISTANCIA
                && !in_array(
                    $params->etapa_educacenso,
                    [25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 70, 71, 73, 74, 64, 67, 68]
                )
            ) {
                $this->message = 'Quando o campo: Tipo de mediação didático-pedagógica é: Educação a Distância, o campo: Etapa de ensino deve ser uma das seguintes opções: 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 70, 71, 73, 74, 64, 67 ou 68.';

                return false;
            }

            if (in_array(
                $params->local_funcionamento_diferenciado,
                [
                             App_Model_LocalFuncionamentoDiferenciado::UNIDADE_ATENDIMENTO_SOCIOEDUCATIVO,
                             App_Model_LocalFuncionamentoDiferenciado::UNIDADE_PRISIONAL
                         ]
            ) && in_array($params->etapa_educacenso, [1, 2, 3, 56])) {
                $nomeOpcao = (App_Model_LocalFuncionamentoDiferenciado::getInstance()->getEnums(
                ))[$params->local_funcionamento_diferenciado];
                $this->message = "Quando o campo: Local de funcionamento diferenciado é: {$nomeOpcao}, o campo: Etapa de ensino não pode ser nenhuma das seguintes opções: 1, 2, 3 ou 56.";

                return false;
            }
        }

        return true;
    }

    protected function validaCampoAtividadesComplementares($params)
    {
        if ($params->tipo_atendimento == TipoAtendimentoTurma::ATIVIDADE_COMPLEMENTAR
            && empty($params->atividades_complementares)
        ) {
            $this->message = 'Campo atividades complementares é obrigatório.';

            return false;
        }

        return true;
    }

    protected function validaCampoEtapaEnsino($tipoAtendimento)
    {
        if (!empty($tipoAtendimento) && !in_array($tipoAtendimento, [-1, 4, 5])) {
            $this->message = 'Campo etapa de ensino é obrigatório';

            return false;
        }

        return true;
    }

    protected function validaCampoTipoAtendimento($params)
    {
        if ($params->tipo_atendimento != TipoAtendimentoTurma::ESCOLARIZACAO && in_array(
            $params->tipo_mediacao_didatico_pedagogico,
            [
                    App_Model_TipoMediacaoDidaticoPedagogico::SEMIPRESENCIAL,
                    App_Model_TipoMediacaoDidaticoPedagogico::EDUCACAO_A_DISTANCIA
                ]
        )) {
            $this->message = 'O campo: Tipo de atendimento deve ser: Escolarização quando o campo: Tipo de mediação didático-pedagógica for: Semipresencial ou Educação a Distância.';

            return false;
        }

        return true;
    }

    protected function validaCampoLocalFuncionamentoDiferenciado($params)
    {
        $school = School::find($params->ref_ref_cod_escola);
        $localFuncionamentoEscola = $school->local_funcionamento;
        if (is_string($localFuncionamentoEscola)) {
            $localFuncionamentoEscola = explode(',', str_replace(['{', '}'], '', $localFuncionamentoEscola));
        }

        $localFuncionamentoEscola = (array)$localFuncionamentoEscola;

        if (!in_array(
            9,
            $localFuncionamentoEscola
        ) && $params->local_funcionamento_diferenciado == App_Model_LocalFuncionamentoDiferenciado::UNIDADE_ATENDIMENTO_SOCIOEDUCATIVO) {
            $this->message = 'Não é possível selecionar a opção: Unidade de atendimento socioeducativo quando o local de funcionamento da escola não for: Unidade de atendimento socioeducativo.';

            return false;
        }

        if (!in_array(
            10,
            $localFuncionamentoEscola
        ) && $params->local_funcionamento_diferenciado == App_Model_LocalFuncionamentoDiferenciado::UNIDADE_PRISIONAL) {
            $this->message = 'Não é possível selecionar a opção: Unidade prisional quando o local de funcionamento da escola não for: Unidade prisional.';

            return false;
        }

        return true;
    }

    private function validaCampoEstruturaCurricular(mixed $params)
    {
        $estruturaCurricular = array_map('intval',
            explode(',', str_replace(['{', '}'], '', $params->estrutura_curricular))
         ?: []);

        if ($params->tipo_atendimento == TipoAtendimentoTurma::ESCOLARIZACAO
            && empty($estruturaCurricular)
        ) {
            $this->message = 'Campo atividades Estrutura Curricular é obrigatório.';
            return false;
        }

        if (count($estruturaCurricular) > 1 && in_array(3, $estruturaCurricular, true)) {
            $this->message = "Não é possível informar mais de uma opção no campo: <b>Estrutura curricular</b>, quando a opção: <b>Não se aplica</b> estiver selecionada";
            return false;
        }

        return true;
    }

    private function validaCampoFormasOrganizacaoTurma(mixed $params)
    {

        $estruturaCurricular = array_map('intval',
            explode(',', str_replace(['{', '}'], '', $params->estrutura_curricular))
                ?: []);

        if (empty($estruturaCurricular)) {
            return true;
        }

        if (!empty($params->formas_organizacao_turma) && in_array(1, $estruturaCurricular, true)) {
            $this->message = 'Campo: <b>Formas de organização da turma</b> é obrigatório quando o campo: <b>Estrutura Curricular contém: Formação geral básica</b>';
            return false;
        }

        if (!empty($params->formas_organizacao_turma) && !in_array(1, $estruturaCurricular, true)) {
            $this->message = 'Campo: <b>Formas de organização da turma</b> não pode ser preenchido quando o campo: <b>Estrutura Curricular não contém: Formação geral básica</b>';
            return false;
        }

        $validOption = [
            1 => 'Série/ano (séries anuais)',
            2 => 'Períodos semestrais',
            3 => 'Ciclo(s)',
            4 => 'Grupos não seriados com base na idade ou competência',
            5 => 'Módulos',
            6 => 'Alternância regular de períodos de estudos'
        ];

        $validOptionCorrelationForEtapaEnsino = [
            1 => [
                14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 41, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 56, 69, 70, 71, 72, 73, 74, 67
            ],
            2 => [
                25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 69, 70, 71, 72, 73, 74, 67, 68
            ],
            3 => [
                14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 41, 56
            ],
            4 => [
                14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 41, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 56, 69, 70, 71, 72, 73, 74, 67, 68
            ],
            5 => [
                14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 41, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 56, 69, 70, 71, 72, 73, 74, 67,68
            ],
            6 => [
                19, 20, 21, 22, 23, 41, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 69, 70, 71, 72, 73, 74, 67, 68
            ]
        ];


        if (!in_array((int) $params->etapa_educacenso, $validOptionCorrelationForEtapaEnsino[(int)$params->formas_organizacao_turma], true)) {
            $todasEtapasEducacenso = loadJson(__DIR__ . '/../../ieducar/intranet/educacenso_json/etapas_ensino.json');
            $this->message = "Não é possível selecionar a opção: <b>{$validOption[(int)$params->formas_organizacao_turma]}</b>, no campo: <b>Formas de organização da turma</b> quando o campo: Etapa de ensino for: {$todasEtapasEducacenso[$params->etapa_educacenso]}.";
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
