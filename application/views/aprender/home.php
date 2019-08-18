<section class="content">
    <div class="row">
        <!-- ./col -->
        <h1 class="col-xs-12 text-center">
            Qual categoria quero estudar hoje? :)
            <br />
            <br />
        </h1>


        <?php
        if (isset($categorias) && sizeof($categorias) > 0) {
            for ($i=0; $i < sizeof($categorias) ; $i++) { 
                ?>
        <a href="<?php echo base_url('aprender/' . $categorias[$i]->ID) ?>" class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-graduation-cap"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text -wrap"><?php echo $categorias[$i]->titulo ?></span>
                    <?php
                            // if (isset($categorias[$i]->num_assuntos)) {
                            //     echo '<span class="info-box-number">';
                            //     echo $categorias[$i]->num_assuntos . ' micro tutoriais';
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