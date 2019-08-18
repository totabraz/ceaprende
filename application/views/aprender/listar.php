<section class="content">
    <div class="row">
        <!-- ./col -->
        <h1 class="col-xs-12 text-center">
            Qual categoria quero estudar hoje? :)
            <br />
            <br />
        </h1>


        <?php
        if (isset($compartilhamentos) && sizeof($compartilhamentos) > 0) {

            foreach ($compartilhamentos as $compartilhamento) {
                $teste = 0;
                $cores = ['bg-green', 'bg-yellow', 'bg-red', 'bg-purple', 'bg-blue'];
                $teste = rand(0, 300) % 5;
                $teste = $cores[$teste];
                ?>
        <a href="<?php echo base_url('aprender/' . $compartilhamento->ID) ?>" class="col-lg-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon <?php echo $teste; ?>"><i class="fa fa-graduation-cap"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text -wrap"><?php echo $compartilhamento->titulo ?></span>
                    <?php
                            if (isset($compartilhamento->num_assuntos)) {
                                echo '<span class="info-box-number">';
                                echo $compartilhamento->num_assuntos . ' pessoas curtiram isso';
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