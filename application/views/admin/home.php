<section class="content">
    <div class="row">
        <div class="col-xs-12 col-sm-4">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php
                        if (isset($num_aulas)) {
                            echo $num_minhas_aulas;
                        }
                    ?></h3>
                    <p>Assunto(s) compartilhado(s)</p>
                </div>
                <div class="icon">
                    <i class="glyphicon glyphicon-blackboard"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-xs-12 col-sm-4">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>5</h3>

                    <p>Assunto(s) aprendido(s)</p>
                </div>
                <div class="icon">
                    <i class="fa fa-rocket"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-xs-12 col-sm-4">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>30</h3>
                    <p>Pontuação total</p>
                </div>
                <div class="icon">
                    <i class="fa fa-trophy"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
    </div>

    <h1 class="col-xs-12 text-center title-to-do" >
        O que deseja fazer hoje?
    </h1>

    <!-- Info boxes -->
    <div class="row">

        <a href="<?php echo base_url('compartilhar')?>" class="col-xs-12 col-sm-6">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-filing"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text -wrap">Compartilhar</span>
                    <?php
                        if (isset($num_aulas)) {
                            echo '<span class="info-box-number">';
                            if ($num_minhas_aulas > 0)
                                echo 'Você já criou ' . $num_minhas_aulas . ' assunto(s)';
                            else
                                echo 'Crie seu primeiro assunto!';
                            echo '</span>';
                        }
                    ?>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </a>
        <!-- fix for small devices only -->
        <div class="clearfix visible-xs-block"></div>

        <a href="<?php echo base_url('aprender')?>" class="col-xs-12 col-sm-6">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-graduation-cap"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text -wrap">Aprender</span>
                    <?php
                        if (isset($num_aulas)) {
                            echo '<span class="info-box-number">';
                            echo $num_aulas . ' cursos disponíveis';
                            echo '</span>';
                        }
                    ?>
                    
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </a>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- /.row -->
</section>