<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- Content Header (Page header) -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php
$news_date_published = changeDateFromDB(isset($news['news_date_published']) ? $news['news_date_published'] : date('d-m-Y'));

?>
<script>
    $(document).ready(function() {
        $(function() {
            $("#datepicker").datepicker();
            $('#datepicker').datepicker("option", "dateFormat", 'dd-mm-yy');
            $("#datepicker").datepicker('setDate', <?php echo changeDateFromDB($news_date_published) ?>);
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
                        <strong class="text-uppercase">Blog</strong> - <em>
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
                                <?php
                                $setup = array(
                                    'class' => 'form-control',
                                    'trim|required'
                                );
                                if ($msg = get_msg()) {
                                    echo $msg;
                                }
                                echo form_open_multipart();

                                $blog_title = isset($blog['blog_title']) ? $blog['blog_title'] : "";
                                $blog_body = isset($blog['blog_body']) ? $blog['blog_body'] : "";
                                $blog_img = isset($blog['blog_img']) ? $blog['blog_img'] : "";
                                $blog_published = isset($blog['blog_published']) ? $blog['blog_published'] : TRUE;
                                $blog_date_to_publish = isset($blog['blog_date_to_publish']) ? $blog['blog_date_to_publish'] : 1;
                                $blog_author_name = (isset($this->session->get_userdata()['name']))? $this->session->get_userdata()['name'] :'';
                                $blog_author_login = (isset($this->session->get_userdata()['login']))? $this->session->get_userdata()['login'] :'';
                                // FORM ADD NEW

                                echo ' <div class="form-group">';
                                $opts = array('name' => 'blog_title', 'value' => $blog_title, 'title' => 'Infome o título');
                                echo form_label('Título:');
                                echo form_input($opts, '', $setup);
                                echo '</div>';


                                echo ' <div class="form-group">';
                                $opts = array('name' => 'blog_date_to_publish', 'id' => 'datepicker', 'value' => $blog_date_to_publish, 'title' => 'Infome a data a ser publicada');
                                echo form_label('Data para publicação:');
                                echo form_input($opts, '', $setup);
                                echo '</div>';

                                echo ' <div class="form-group">';
                                $opts = array('name' => 'blog_author_name', 'value' => $blog_author_name, 'title' => 'Autor', 'readonly' => 'readonly');
                                echo form_label('Autor Name:');
                                echo form_input($opts, '', $setup);
                                echo '</div>';
                                
                                echo ' <div class="form-group">';
                                $opts = array('name' => 'blog_author_login', 'value' => $blog_author_login, 'title' => 'Autor', 'readonly' => 'readonly');
                                echo form_label('Autor Login:');
                                echo form_input($opts, '', $setup);
                                echo '</div>';

                                echo ' <div class="form-group">';
                                echo form_label('Postagem:');

                                $opts = array(
                                    'name'        => 'blog_body',
                                    // 'id'          => 'vc_desc',
                                    'value'       => $blog_body,
                                    'rows'        => '10',
                                    'cols'        => '10',
                                    'style'       => 'width:100%',
                                    'class'       => 'form-control',
                                    'title' => 'Postagem'
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
                                                    <input id="imgFormInput" type="file" name="blog_img" size="20">

                                                </div>
                                            </div>
                                        </div>

                                        <?php if (isset($blog_img) && $blog_img != '') { ?>
                                            <figure class="col-xs-12 col-sm-6 col-md-3">
                                                <img src="<?php echo base_url('uploads/') . $blog_img ;?>" style="width:100px; height:100px;" />
                                            </figure>
                                        <?php } ?>
                                    </div>
                                </div>

                                <?php
                                echo '<div class="row">';


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
                                    'name' => 'blog_published',
                                    'value' => $blog_published, 'title' => 'Essa notícia está publicada?',
                                    'class' => 'form-control editorhtml col'
                                );
                                echo form_dropdown($opts, $arrayOpts);
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';

                                echo '</div>';

                                // ====== Add other
                                

                                // ====== Submit
                                echo '<div class="pull-rihgt text-right middle-flex -mf-right">';
                                echo form_label('Adicionar Outra Postagem &nbsp;');
                                echo form_checkbox(
                                    'addmore',
                                    'Adicionar Outra Postagem',
                                    TRUE
                                );
                                
                                echo form_submit(
                                    'enviar',
                                    'Salvar',
                                    array('class' => 'btn btn-success pull-right')
                                );
                                echo '</div>';
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