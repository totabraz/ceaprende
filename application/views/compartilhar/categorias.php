<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- /.box -->
            <div class="box">
                <section class="content-header">
                    <h1 class=" col-xs-12 text-center">
                        <strong class="text-uppercase">Cadastrar</strong> - <em>Categorias</em>
                    </h1>
                </section>
                <hr class="col-xs-12" />
                <!-- /.box-header -->
                <div class="box-body">
                    
                    <?php
                    $setup = array('class' => 'form-control', 'trim|required');
                    if ($msg = get_msg()) {
                        echo $msg;
                    }
                    echo form_open();

                    $titulo = isset($form_input['titulo']) ? $form_input['titulo'] : "";
                    $ID = isset($form_input['ID']) ? $form_input['ID'] : "";

                    echo ' <div class="form-group">';
                    $opts = array('name' => 'titulo', 'value' => $titulo, 'title' => 'Cadastrar nova categoria');
                    echo form_label('Cadastrar nova categoria:');
                    echo form_input($opts, '', $setup);
                    echo '</div>';                    
                    echo form_submit('enviar', 'Salvar', array('class' => 'btn btn-success pull-right'));


                    // Form Closed
                    echo form_close();
                    ?>
                </div>
                <div class="box-body">
                    <?php
                    if ($msg = get_msg()) {
                        echo $msg;
                    }
                    if (isset($categorias) && sizeof($categorias) > 0) { ?>

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Categoria</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $index = true ?>
                            <?php foreach ($categorias as $categoria) { ?>
                            <?php if ($index) { } ?>
                            <tr class="<?php if (isset($categoria->blocked) && $categoria->blocked) echo 'inative' ?>">
                                <td><?php if (isset($categoria->ID)) echo $categoria->ID ?></td>
                                <td><?php if (isset($categoria->titulo)) echo $categoria->titulo ?></td>
                                <td>
                                    <a href="<?php echo base_url('compartilhar/editar/' . $categoria->ID) ?>" class="btn btn-small btn-info" titulo="Editar">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Categoria</th>
                                <th>Ações</th>
                            </tr>
                        </tfoot>
                    </table>
                    <?php } else {
                        ?>
                    <p>Sem informações cadastradas</p>
                    <?php
                    } ?>
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