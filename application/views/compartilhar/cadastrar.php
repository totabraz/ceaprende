<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- /.box -->
            <div class="box">
                <section class="content-header">
                    <h1 class=" col-xs-12 text-center">
                        <strong class="text-uppercase">Compartilhar</strong>
                    </h1>
                </section>
                <hr class="col-xs-12" />
                <!-- /.box-header -->
                <div class="box-body">
                    <h2 class=" col-xs-12 text-center text-uppercase no-margin">
                        Assunto
                    </h2>
                    <?php
                    $setup = array('class' => 'form-control', 'trim|required');
                    if ($msg = get_msg()) {
                        echo $msg;
                    }
                    echo form_open();

                    $id_categoria = isset($dados['id_categoria']) ? $dados['id_categoria'] : '';
                    $titulo = isset($dados['titulo']) ? $dados['titulo'] : '';
                    $conteudo = isset($dados['conteudo']) ? $dados['conteudo'] : '';
                    $referencia = isset($dados['referencia']) ? $dados['referencia'] : '';
                    $pergunta1 = isset($dados['pergunta1']) ? $dados['pergunta1'] : '';
                    $resposta11 = isset($dados['resposta11']) ? $dados['resposta11'] : '';
                    $resposta12 = isset($dados['resposta12']) ? $dados['resposta12'] : '';
                    $resposta13 = isset($dados['resposta13']) ? $dados['resposta13'] : '';
                    $resposta14 = isset($dados['resposta14']) ? $dados['resposta14'] : '';
                    $pergunta2 = isset($dados['pergunta2']) ? $dados['pergunta2'] : '';
                    $resposta21 = isset($dados['resposta21']) ? $dados['resposta21'] : '';
                    $resposta22 = isset($dados['resposta22']) ? $dados['resposta22'] : '';
                    $resposta23 = isset($dados['resposta23']) ? $dados['resposta23'] : '';
                    $resposta24 = isset($dados['resposta24']) ? $dados['resposta24'] : '';
                    $pergunta3 = isset($dados['pergunta3']) ? $dados['pergunta3'] : '';
                    $resposta31 = isset($dados['resposta31']) ? $dados['resposta31'] : '';
                    $resposta32 = isset($dados['resposta32']) ? $dados['resposta32'] : '';
                    $resposta33 = isset($dados['resposta33']) ? $dados['resposta33'] : '';
                    $resposta34 = isset($dados['resposta34']) ? $dados['resposta34'] : '';






                    echo '<div class="form-group">';
                    echo '<div class="row">';
                    echo '<div class="col-xs-12">';
                    echo form_label('Categoria:');
                    echo '</div>';
                    echo '<div class="col-xs-12">';
                    $arrayOpts[0] = '';
                    foreach ($categorias as $categoria) {
                        $arrayOpts[$categoria->ID] = $categoria->titulo;
                    }
                    $opts = array('autocomplete' => 'off', 'name' => 'id_categoria', 'value' => $id_categoria, 'title' => 'Categoria', 'class' => 'form-control editorhtml col');
                    echo form_dropdown($opts, $arrayOpts);
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';




                    echo ' <div class="form-group">';
                    $opts = array('name' => 'titulo', 'value' => $titulo, 'title' => 'Assunto');
                    echo form_label('Assunto');
                    echo form_input($opts, '', $setup);
                    echo '</div>';

                    echo ' <div class="form-group">';
                    $opts = array('name' => 'conteudo', 'value' => $conteudo, 'title' => 'Conteúdo');
                    echo form_label('Conteúdo');
                    echo form_textarea($opts, '', $setup);
                    echo '</div>';

                    echo ' <div class="form-group">';
                    $opts = array('name' => 'referencia', 'value' => $referencia, 'title' => 'Referencia');
                    echo form_label('Referencia');
                    echo form_textarea($opts, '', $setup);
                    echo '</div>';



                    echo ' <div class="form-group">';

                    ?>
                    <hr class="col-xs-12" />

                    <h2 class=" col-xs-12 text-center text-uppercase no-margin">
                        Lição
                    </h2>
                    <?php

                    echo '</div>';


                    echo ' <div class="form-group">';
                    $opts = array('name' => 'pergunta1', 'value' => $pergunta1, 'title' => 'Pergunta 01');
                    echo form_label('Pergunta 01');
                    echo form_input($opts, '', $setup);
                    echo '</div>';

                    echo ' <div class="form-group">';
                    $opts = array('name' => 'resposta11', 'value' => $resposta11, 'title' => '[Pergunta01] Resposta CERTA');
                    echo form_label('[Pergunta01] Resposta CERTA');
                    echo form_input($opts, '', $setup);
                    echo '</div>';

                    echo ' <div class="form-group">';
                    $opts = array('name' => 'resposta12', 'value' => $resposta12, 'title' => '[Pergunta01] Resposta ERRADA');
                    echo form_label('[Pergunta01] Resposta ERRADA');
                    echo form_input($opts, '', $setup);
                    echo '</div>';

                    echo ' <div class="form-group">';
                    $opts = array('name' => 'resposta13', 'value' => $resposta13, 'title' => '[Pergunta01] Resposta ERRADA');
                    echo form_label('[Pergunta01] Resposta ERRADA');
                    echo form_input($opts, '', $setup);
                    echo '</div>';

                    echo ' <div class="form-group">';
                    $opts = array('name' => 'resposta14', 'value' => $resposta14, 'title' => '[Pergunta01] Resposta ERRADA');
                    echo form_label('[Pergunta01] Resposta ERRADA');
                    echo form_input($opts, '', $setup);
                    echo '</div>';

                    echo ' <div class="form-group">';
                    $opts = array('name' => 'pergunta2', 'value' => $pergunta2, 'title' => 'Pergunta 02');
                    echo form_label('Pergunta 02');
                    echo form_input($opts, '', $setup);
                    echo '</div>';

                    echo ' <div class="form-group">';
                    $opts = array('name' => 'resposta21', 'value' => $resposta21, 'title' => '[Pergunta02] Resposta CERTA');
                    echo form_label('[Pergunta02] Resposta CERTA');
                    echo form_input($opts, '', $setup);
                    echo '</div>';

                    echo ' <div class="form-group">';
                    $opts = array('name' => 'resposta22', 'value' => $resposta22, 'title' => '[Pergunta02] Resposta ERRADA');
                    echo form_label('[Pergunta02] Resposta ERRADA');
                    echo form_input($opts, '', $setup);
                    echo '</div>';

                    echo ' <div class="form-group">';
                    $opts = array('name' => 'resposta23', 'value' => $resposta23, 'title' => '[Pergunta02] Resposta ERRADA');
                    echo form_label('[Pergunta02] Resposta ERRADA');
                    echo form_input($opts, '', $setup);
                    echo '</div>';

                    echo ' <div class="form-group">';
                    $opts = array('name' => 'resposta24', 'value' => $resposta24, 'title' => '[Pergunta02] Resposta ERRADA');
                    echo form_label('[Pergunta02] Resposta ERRADA');
                    echo form_input($opts, '', $setup);
                    echo '</div>';

                    echo ' <div class="form-group">';
                    $opts = array('name' => 'pergunta3', 'value' => $pergunta3, 'title' => 'Pergunta 03');
                    echo form_label('Pergunta 03');
                    echo form_input($opts, '', $setup);
                    echo '</div>';

                    echo ' <div class="form-group">';
                    $opts = array('name' => 'resposta31', 'value' => $resposta31, 'title' => '[Pergunta03] Resposta CERTA');
                    echo form_label('[Pergunta03] Resposta CERTA');
                    echo form_input($opts, '', $setup);
                    echo '</div>';

                    echo ' <div class="form-group">';
                    $opts = array('name' => 'resposta32', 'value' => $resposta32, 'title' => '[Pergunta03] Resposta ERRADA');
                    echo form_label('[Pergunta03] Resposta ERRADA');
                    echo form_input($opts, '', $setup);
                    echo '</div>';

                    echo ' <div class="form-group">';
                    $opts = array('name' => 'resposta33', 'value' => $resposta33, 'title' => '[Pergunta03] Resposta ERRADA');
                    echo form_label('[Pergunta03] Resposta ERRADA');
                    echo form_input($opts, '', $setup);
                    echo '</div>';

                    echo ' <div class="form-group">';
                    $opts = array('name' => 'resposta34', 'value' => $resposta34, 'title' => '[Pergunta03] Resposta ERRADA');
                    echo form_label('[Pergunta03] Resposta ERRADA');
                    echo form_input($opts, '', $setup);
                    echo '</div>';




















                    echo form_submit('enviar', 'Salvar', array('class' => 'btn btn-success pull-right'));


                    // Form Closed
                    echo form_close();
                    ?>
                </div>

                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.wrapper-content -->
<!-- fica no header -->
</div>