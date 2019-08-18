<?php

$curtidas =  isset($assunto->curtidas) ?  $assunto->curtidas : 0;
$titulo =  isset($assunto->titulo) ?  $assunto->titulo : '';
$conteudo =  isset($assunto->conteudo) ?  $assunto->conteudo : '';
$referencia =  isset($assunto->referencia) ?  $assunto->referencia : '';
$pergunta1 =  isset($assunto->pergunta1) ?  $assunto->pergunta1 : '';
$resposta11 =  isset($assunto->resposta11) ?  $assunto->resposta11 : '';
$resposta12 =  isset($assunto->resposta12) ?  $assunto->resposta12 : '';
$resposta13 =  isset($assunto->resposta13) ?  $assunto->resposta13 : '';
$resposta14 =  isset($assunto->resposta14) ?  $assunto->resposta14 : '';
$pergunta2 =  isset($assunto->pergunta2) ?  $assunto->pergunta2 : '';
$resposta21 =  isset($assunto->resposta21) ?  $assunto->resposta21 : '';
$resposta22 =  isset($assunto->resposta22) ?  $assunto->resposta22 : '';
$resposta23 =  isset($assunto->resposta23) ?  $assunto->resposta23 : '';
$resposta24 =  isset($assunto->resposta24) ?  $assunto->resposta24 : '';
$pergunta3 =  isset($assunto->pergunta3) ?  $assunto->pergunta3 : '';
$resposta31 =  isset($assunto->resposta31) ?  $assunto->resposta31 : '';
$resposta32 =  isset($assunto->resposta32) ?  $assunto->resposta32 : '';
$resposta33 =  isset($assunto->resposta33) ?  $assunto->resposta33 : '';
$resposta34 =  isset($assunto->resposta34) ?  $assunto->resposta34 : '';
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>
                        <?php
                        echo $curtidas;
                        ?>
                    </h3>
                    <p>
                        <?php if ($curtidas === 1) echo "pessoa gostou deste conteúdo";
                        else echo "pessoas gostaram este assunto"; ?>
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-thumbs-o-up"></i>
                </div>
            </div>
        </div>
        <h1 class="col-xs-12 text-center">
            <?php echo $titulo;
            echo "<br /><br />" ?>
        </h1>
        <div class="col-xs-12 col-sm-6">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Entenda</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body " style="">
                    <p>
                        <?php echo $conteudo ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Referências</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body " style="">
                    <p>
                        <?php echo $conteudo ?>

                    </p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Teste se aprendeu..</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body " style="">

                    <?php
                    echo form_open();
                    echo '<div class="form-group">';
                    echo '<div class="row">';
                    echo '<div class="col-xs-12">';
                    echo form_label('$pergunta1:');
                    echo '</div>';
                    echo '<div class="col-xs-12">';
                    $arrayOpts = array(
                        'resposta11' => $resposta11,
                        'resposta12' => $resposta12,
                        'resposta13' => $resposta13,
                        'resposta14' => $resposta14
                    );
                    $opts = array('autocomplete' => 'off', 'name' => 'pergunta1', 'value' => $pergunta1, 'title' => 'Categoria', 'class' => 'form-control editorhtml col');
                    echo form_dropdown($opts, $arrayOpts);
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    echo '<div class="form-group">';
                    echo '<div class="row">';
                    echo '<div class="col-xs-12">';
                    echo form_label('$pergunta1:');
                    echo '</div>';
                    echo '<div class="col-xs-12">';
                    $arrayOpts = array(
                        'resposta11' => $resposta11,
                        'resposta12' => $resposta12,
                        'resposta13' => $resposta13,
                        'resposta14' => $resposta14
                    );
                    $opts = array('autocomplete' => 'off', 'name' => 'pergunta1', 'value' => $pergunta1, 'title' => 'Categoria', 'class' => 'form-control editorhtml col');
                    echo form_dropdown($opts, $arrayOpts);
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    // Pregunta 2
                    echo '<div class="form-group">';
                    echo '<div class="row">';
                    echo '<div class="col-xs-12">';
                    echo form_label('$pergunta2:');
                    echo '</div>';
                    echo '<div class="col-xs-12">';
                    $arrayOpts = array(
                        'resposta21' => $resposta21,
                        'resposta22' => $resposta22,
                        'resposta23' => $resposta23,
                        'resposta24' => $resposta24
                    );
                    $opts = array('autocomplete' => 'off', 'name' => 'pergunta2', 'value' => $pergunta2, 'title' => 'Categoria', 'class' => 'form-control editorhtml col');
                    echo form_dropdown($opts, $arrayOpts);
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    // Pregunta 3
                    echo '<div class="form-group">';
                    echo '<div class="row">';
                    echo '<div class="col-xs-12">';
                    echo form_label('$pergunta3:');
                    echo '</div>';
                    echo '<div class="col-xs-12">';
                    $arrayOpts = array(
                        'resposta31' => $resposta31,
                        'resposta32' => $resposta32,
                        'resposta33' => $resposta33,
                        'resposta34' => $resposta34
                    );
                    $opts = array('autocomplete' => 'off', 'name' => 'pergunta3', 'value' => $pergunta3, 'title' => 'Categoria', 'class' => 'form-control editorhtml col');
                    echo form_dropdown($opts, $arrayOpts);
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    echo form_submit('enviar', 'Salvar', array('class' => 'btn btn-warning pull-right'));

                    echo form_close();

                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Info boxes -->
    <div class="row">
        <a href="#" class="col-lg-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-thumbs-o-up"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text -wrap">Gotou do assunto?</span>
                    <p>Curtir</p>
                </div>   
            </div>
        </a>
    </div>
</section>












































