// Data de saída
window.onload = function () {

  const makeDialog = function (params) {
    let container = $j('#dialog-container');

    if (container.length < 1) {
      $j('body').append('<div id="dialog-container" style="width: 400px;"></div>');
      container = $j('#dialog-container');
    }

    if (container.hasClass('ui-dialog-content')) {
      container.dialog('destroy');
    }

    container.empty();
    container.html(params.content);

    delete params['content'];

    container.dialog(params);
  }

  const defaultModal = function (message) {
    makeDialog({
      content: message,
      title: 'Atenção!',
      maxWidth: 400,
      width: 400,
      close: function () {
        $j('#dialog-container').dialog('destroy');
      },
      buttons: [{
        text: 'Ok',
        click: function () {
          $j('#dialog-container').dialog('destroy');
        }
      },]
    });
  }

  const matriculaSituacao = document.getElementById('matricula_situacao').value;
  const deletationDate = document.getElementById('data_exclusao');

  const validationDateExclutionRule = function () {
    const deletationDateValue = deletationDate.value;

    if (matriculaSituacao === 'remanejado' && typeof deletationDateValue === 'string' && deletationDateValue === '') {
      defaultModal('A data de saída é obrigatória quando é marcado o remanejamento.')
      return false;
    }
    acao();
  }

  const submitValitation = document.getElementById('btn_enviar');

  submitValitation.onclick = function () {
    validationDateExclutionRule();
  }

  const valitadeDateExclution = function () {
    document.getElementById('matricula_situacao').trigger('chosen:updated');
    if (document.getElementById('matricula_situacao').value === 'remanejado') {
      makeRequired('data_exclusao');
      return;
    }

    makeUnrequired('data_exclusao');
  };

  document.getElementById('matricula_situacao').addEventListener('change', valitadeDateExclution)

  valitadeDateExclution();
}




