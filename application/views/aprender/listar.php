<section class="content">
    <div class="row">
        <!-- ./col -->
        <h1 class="col-xs-12 text-center">
            E qual assunto? :D
            <br />
            <br />
        </h1>


        <?php
        if (isset($compartilhamentos) && sizeof($compartilhamentos) > 0) {
            for ($i = 0; $i < sizeof($compartilhamentos); $i++) {
                ?>
            <div class="col-xs-6 col-md-4">
                <div class="box box-aprender">
                    <div class="box-header ui-sortable-handle" style="cursor: move;">
                        <a href="<?php echo base_url('aprender/' . $id_categoria .'/' .$compartilhamentos[$i]->ID) ?>">
                            <h3 class="box-title"><?php echo $compartilhamentos[$i]->titulo ?></h3>
                        </a>
                        <h5>Autor</h5>
                    </div>
                    <div class="share-list-screen__card-footer">
                        <div class="share-list-screen__stats">
                            <div class="group">
                                <i class="fa fa-thumbs-up"></i>
                                <p>13</p>
                            </div>
                            
                        </div>
                        <div class="share-list-screen__actions">
                            <button id="aaa" data-id="" type="button" class="btn btn-danger btn-remove">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                        <?php
                                // if (isset($compartilhamentos[$i]->num_assuntos)) {
                                //     echo '<span class="info-box-number">';
                                //     echo $compartilhamentos[$i]->num_assuntos . ' pessoas curtiram isso';
                                //     echo '</span>';
                                // }
                                // ?>
            </div>                    
        <?php
            }
        }

        ?>
</section>