<?php

use App\Models\LegacySchoolClassType;

return new class extends clsCadastro {
    public $pessoa_logada;
    public $cod_turma_tipo;
    public $ref_usuario_exc;
    public $ref_usuario_cad;
    public $nm_tipo;
    public $sgl_tipo;
    public $data_cadastro;
    public $data_exclusao;
    public $ativo;
    public $ref_cod_instituicao;
    public $ref_cod_escola;

    public function Inicializar()
    {
        $retorno = 'Novo';

        $this->cod_turma_tipo = $_GET['cod_turma_tipo'];

        $obj_permissoes = new clsPermissoes();
        $obj_permissoes->permissao_cadastra(570, $this->pessoa_logada, 7, 'educar_turma_tipo_lst.php');

        if (is_numeric($this->cod_turma_tipo)) {
            $registro = LegacySchoolClassType::findOrFail($this->cod_turma_tipo)->getAttributes();
            if ($registro) {
                foreach ($registro as $campo => $val) {  // passa todos os valores obtidos no registro para atributos do objeto
                    $this->$campo = $val;
                }

                $this->fexcluir = $obj_permissoes->permissao_excluir(570, $this->pessoa_logada, 7);
                $retorno = 'Editar';
            }
        }
        $this->url_cancelar = ($retorno == 'Editar') ? "educar_turma_tipo_det.php?cod_turma_tipo={$registro['cod_turma_tipo']}" : 'educar_turma_tipo_lst.php';

        $nomeMenu = $retorno == 'Editar' ? $retorno : 'Novo';

        $this->breadcrumb($nomeMenu . ' tipo de turma', [
            url('intranet/educar_index.php') => 'Escola',
        ]);

        $this->nome_url_cancelar = 'Cancelar';

        return $retorno;
    }

    public function Gerar()
    {
        // primary keys
        $this->campoOculto('cod_turma_tipo', $this->cod_turma_tipo);

        $obrigatorio = true;
        // foreign keys
        $get_escola = false;
        include('include/pmieducar/educar_campo_lista.php');

        // text
        $this->campoTexto('nm_tipo', 'Turma Tipo', $this->nm_tipo, 30, 255, true);
        $this->campoTexto('sgl_tipo', 'Sigla', $this->sgl_tipo, 15, 15, true);
    }

    public function Novo()
    {
        $classType = new LegacySchoolClassType();
        $classType->ref_usuario_cad = $this->pessoa_logada;
        $classType->nm_tipo = $this->nm_tipo;
        $classType->sgl_tipo = $this->sgl_tipo;
        $classType->ref_cod_instituicao = $this->ref_cod_instituicao;

        if ($classType->save()) {
            $this->mensagem .= 'Cadastro efetuado com sucesso.<br>';
            $this->simpleRedirect('educar_turma_tipo_lst.php');
        }

        $this->mensagem = 'Cadastro não realizado.<br>';
        return false;
    }

    public function Editar()
    {
        $classType = LegacySchoolClassType::findOrFail($this->cod_turma_tipo);
        $classType->ref_usuario_cad = $this->pessoa_logada;
        $classType->nm_tipo = $this->nm_tipo;
        $classType->sgl_tipo = $this->sgl_tipo;
        $classType->ref_cod_instituicao = $this->ref_cod_instituicao;
        $classType->ativo = 1;

        if ($classType->save()) {
            $this->mensagem .= 'Edição efetuada com sucesso.<br>';
            $this->simpleRedirect('educar_turma_tipo_lst.php');
        }

        $this->mensagem = 'Edição não realizada.<br>';
        return false;
    }

    public function Excluir()
    {
        $classType = LegacySchoolClassType::findOrFail($this->cod_turma_tipo);
        $classType->ativo = 0;

        if ($classType->save()) {
            $this->mensagem .= 'Exclusão efetuada com sucesso.<br>';
            $this->simpleRedirect('educar_turma_tipo_lst.php');
        }

        $this->mensagem = 'Exclusão não realizada.<br>';
        return false;
    }

    public function Formular()
    {
        $this->title = 'Turma Tipo';
        $this->processoAp = '570';
    }
};
