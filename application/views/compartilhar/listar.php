<script>
  $(document).ready(() => {
    // const btn = document.querySelector('#btn-removee');
    // btn.addEventListener('click', () => console.log('aehow'))
    $('#btn-remove').click(() => {
      console.log('aeho')
      $('#modal-remove-share').modal('show');
    })

  })
</script>

<div class="container share-list-screen">
  <div id="modal-remove-share" class="modal fade" tabindex="-1" role="dialog" data-backdrop="false">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <h4>Deseja mesmo remover?</h4>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger">Deletar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <section class="content-header">
    <h1>
      Conteúdo
      <!-- <small>Preview</small> -->
    </h1>
  </section>
  <div class="row">
    <div class="col-xs-12 col-md-4">
      <div class="box">
        <div class="box-header ui-sortable-handle" style="cursor: move;">

          <h3 class="box-title">Titulo massa aqui</h3>
          <h5>Uma categoria legal</h5>
        </div>
        <div class="share-list-screen__card-footer">
          <div class="share-list-screen__stats">
            <div class="group">
              <i class="fa fa-thumbs-up"></i>
              <p>12</p>
            </div>
            <div class="group">
              <i class="fa fa-user"></i>
              <p>12</p>
            </div>
          </div>
          <div class="share-list-screen__actions">
            <button id="btn-remove" type="button" class="btn btn-danger">
              <i class="fa fa-trash"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>