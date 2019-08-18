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
        <a href="<?php echo base_url('aprender/' . $id_categoria .'/' .$compartilhamentos[$i]->ID) ?>" class="col-lg-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-graduation-cap"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text -wrap"><?php echo $compartilhamentos[$i]->titulo ?></span>
                    <?php
                            // if (isset($compartilhamentos[$i]->num_assuntos)) {
                            //     echo '<span class="info-box-number">';
                            //     echo $compartilhamentos[$i]->num_assuntos . ' pessoas curtiram isso';
                            //     echo '</span>';
                            // }
                            // ?>

                </div>
            </div>
        </a>
        <?php
            }
        }

        ?>

    </div>
</section>