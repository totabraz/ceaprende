
<!-- Three columns of text below the carousel -->
<div class="row">
  <?php 
  if ($documentos = $this->documentos->getDocumentos(3)){
    foreach ($documentos as $documento) {
      ?>
      <div class="col-lg-4">
        <img class="rounded-circle" src="<?php echo base_url('uploads/'. $documento->imagem);?>" alt="Generic placeholder image" width="140" height="140">
        <h2><?php echo textToHtml($documento->title); ?></h2>
        <p><?php echo textToHtml($documento->conteudo); ?></p>
        <p><a class="btn btn-secondary" href="<?php echo base_url('documentos/documento/' . $documento->id); ?>  " role="button">Leia mais &raquo;</a></p>
      </div>
      <?php
    }
  } else {
    echo '<p>Nenhuma notícia foi encontrada</p>';
  }
  ?>
</div><!-- /.row -->


<!-- START THE FEATURETTES -->