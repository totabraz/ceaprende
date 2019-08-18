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

            foreach ($categorias as $categoria) {
                $teste = 0;
                $cores = ['bg-green', 'bg-yellow', 'bg-red', 'bg-purple', 'bg-blue'];
                $teste = rand(0, 4);
                $teste = $cores[$teste];
                ?>
        <a href="<?php echo base_url('aprender/' . $categoria->ID) ?>" class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon <?php echo $teste; ?>"><i class="fa fa-graduation-cap"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text -wrap"><?php echo $categoria->titulo ?></span>
                    <?php
                            if (isset($categoria->curtidas)) {
                                echo '<span class="info-box-number">';
                                echo $categoria->curtidas . ' pessoas curtiram isso';
                                echo '</span>';
                            }
                            ?>

                </div>
            </div>
        </a>
        <?php
            }
        }

        ?>

    </div>
</section>