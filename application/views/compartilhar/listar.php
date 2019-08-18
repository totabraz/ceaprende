<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- /.box -->
            <div class="box">
                <section class="content-header">
                        <h1 class=" col-xs-12 text-center">
                        <strong class="text-uppercase">Compartilhar</strong> - <em>Listagem</em>
                        <a href="<?php echo base_url('compartilhar/cadastrar')?>" class="btn btn-success pull-right">
                        <i class="fa fa-plus"></i>
                        </a>
                    </h1>
                   
                </section>
                <hr class="col-xs-12" />
                <!-- /.box-header -->
                <div class="box-body">
                    <?php
                    if ($msg = get_msg()) {
                        echo $msg;
                    }
                    if (isset($compartilhamentos) && sizeof($compartilhamentos) > 0) { ?>

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Categoria</th>
                                <th>Titulo</th>
                                <th>Gostei</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $index = true ?>
                            <?php foreach ($compartilhamentos as $compartilhamento) { ?>
                            <?php if ($index) { } ?>
                            <tr>
                                <td><?php if (isset($compartilhamento->ID)) echo $compartilhamento->ID ?></td>
                                <td><?php if (isset($compartilhamento->categoria)) echo $compartilhamento->categoria ?></td>

                                <td><?php if (isset($compartilhamento->titulo)) echo $compartilhamento->titulo ?></td>
                                <td><?php if (isset($compartilhamento->curtidas)) echo $compartilhamento->curtidas ?></td>

                                <td>
                                    <a href="<?php echo base_url('compartilhar/excluir/' . $compartilhamento->ID) ?>" class="btn btn-small btn-danger" title="Editar">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Categoria</th>
                                <th>Titulo</th>
                                <th>Gostei</th>
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