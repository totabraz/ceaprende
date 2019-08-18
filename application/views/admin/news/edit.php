<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- Content Header (Page header) -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<?php
printInfoDump($news);
$news_date_published = changeDateFromDB(isset($news['news_date_published']) ? $news['news_date_published'] : date('d-m-Y'));

?>
<?php echo '---' . $news_date_published . '<br/>'; ?>
<script>
    $(document).ready(function() {
        $(function() {
            $("#datepicker").datepicker();
            $('#datepicker').datepicker("option", "dateFormat", 'dd-mm-yy');
            $("#datepicker").datepicker('setDate', <?php echo changeDateFromDB($news_date_published) ?>);
    
            <?php echo '---' . $news_date_published . '<br/>'; ?>

            
        });
    });
</script>

<style>
    .ui-widget-content.ui-helper-clearfix.ui-corner-all {
        z-index: 8010 !important;
    }
</style>

<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12 col-dm-10 col-md-8 col-lg-6 ">
            <!-- /.box -->
            <div class="box">
                <section class="content-header">
                    <h1 class=" col-xs-12 text-center">
                        <strong class="text-uppercase">Notícias</strong> - <em>
                            <?php
                            if (isset($title)) echo $title;
                            else echo "Nova/Editar Notícia";
                            ?>
                        </em>
                    </h1>
                </section>
                <hr class="" />
                <!-- /.box -->
                <div class="box-body">
                    <?php if ($msg = get_msg()) echo $msg; ?>
                    <div class="">
                        <div class="card">
                            <div class="card-body">
<?php echo '---' . $news_date_published . '<br/>'; ?>

                                <?php
                                $setup = array(
                                    'class' => 'form-control',
                                    'trim|required'
                                );
                                if ($msg = get_msg()) {
                                    echo $msg;
                                }
                                echo form_open_multipart();

                                $news_title = isset($news['news_title']) ? $news['news_title'] : "";
                                $news_body = isset($news['news_body']) ? $news['news_body'] : "";
                                $news_img = isset($news['news_img']) ? $news['news_img'] : "";
                                $news_highlight = isset($news['news_highlight']) ? $news['news_highlight'] : 0;
                                $news_date_to_publish = isset($news['news_date_to_publish']) ? $news['news_date_to_publish'] : 00-00-0000;
                                $news_published = isset($news['news_published']) ? $news['news_published'] : 1;
                                // FORM ADD NEW

                                echo ' <div class="form-group">';
                                $opts = array('name' => 'news_title', 'value' => $news_title, 'title' => 'Infome o título');
                                echo form_label('Título:');
                                echo form_input($opts, '', $setup);
                                echo '</div>';


                                echo ' <div class="form-group">';
                                $opts = array('name' => 'news_date_to_publish', 'id' => 'datepicker', 'value' => $news_date_to_publish, 'title' => 'Infome a data a ser publicada');
                                echo form_label('Data para publicação:');
                                echo form_input($opts, '', $setup);
                                echo '</div>';

                                echo ' <div class="form-group">';
                                $opts = array('name' => 'news_date_published', 'value' => $news_date_published, 'title' => 'Data de criação', 'readonly' => 'readonly');
                                echo form_label('Data de criação:');
                                echo form_input($opts, '', $setup);
                                echo '</div>';

                                echo ' <div class="form-group">';
                                echo form_label('Texto da notícia:');

                                $opts = array(
                                    'name'        => 'news_body',
                                    // 'id'          => 'vc_desc',
                                    'value'       => $news_body,
                                    'rows'        => '10',
                                    'cols'        => '10',
                                    'style'       => 'width:100%',
                                    'class'       => 'form-control',
                                    'title' => 'Texto da notícia'
                                );
                                echo form_textarea($opts);
                                echo '</div>';


                                // === Add File 

                                ?>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <label class="custom-file-label" for="imgFormInput">Anexar Imagem</label>
                                                    <input id="imgFormInput" type="file" name="news_img" size="20">

                                                </div>
                                            </div>
                                        </div>

                                        <?php if (isset($news_img) && $news_img != '') { ?>
                                            <figure class="col-xs-12 col-sm-6 col-md-3">
                                                <img src="<?php echo base_url('uploads/') . $news_img ;?>" style="width:100px; height:100px;" />
                                            </figure>
                                        <?php } ?>
                                    </div>
                                </div>

                                <?php
                                echo '<div class="row">';
                                // ====== Destaque

                                echo '<div class="col-xs-12 col-sm-6 form-group">';
                                echo '<div class="row">';
                                echo '<div class="col-xs-12">';
                                echo form_label('Destaque?');
                                echo '</div>';
                                echo '<div class="col-xs-12">';
                                $arrayOpts = array(
                                    "0" => "Não",
                                    "1" => "Sim"
                                );
                                $opts = array(
                                    'autocomplete' => 'off',
                                    'name' => 'news_highlight',
                                    'value' => $news_highlight, 'title' => 'Notícia do tipo destaque?',
                                    'class' => 'form-control editorhtml col'
                                );
                                echo form_dropdown($opts, $arrayOpts);
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';



                                // ====== Habilitar/Desabilitar
                                echo '<div class="col-xs-12 col-sm-6 form-group">';
                                echo '<div class="row">';
                                echo '<div class="col-xs-12">';
                                echo form_label('Publicada');
                                echo '</div>';
                                echo '<div class="col-xs-12">';
                                $arrayOpts = array(
                                    "0" => "Não",
                                    "1" => "Sim"
                                );
                                $opts = array(
                                    'autocomplete' => 'off',
                                    'name' => 'news_published',
                                    'value' => $news_published, 'title' => 'Essa notícia está publicada?',
                                    'class' => 'form-control editorhtml col'
                                );
                                echo form_dropdown($opts, $arrayOpts);
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';

                                echo '</div>';

                                // ====== Submit
                                echo form_submit(
                                    'enviar',
                                    'Salvar',
                                    array('class' => 'btn btn-success pull-right')
                                );
                                // Form Closed
                                echo form_close();
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- Wrap -->
                </div>
            </div>
        </div>
    </div>
</section>
</div>


<script>
    
    var $hora = ['22','00','00'];    var $url = 'txDHMarcacao=' + $hora[0]+'%3A'+ $hora[1]+ '%3A' + $hora[2]+ '&txHour=' + $hora[0] + '&txMinute=' + $hora[1] + '&txSeconds=' + $hora[2] + '&txLatitude=0.0&txLongitude=0.0&cboLocal=3022;';
    
</script>