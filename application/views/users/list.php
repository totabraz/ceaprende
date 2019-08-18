<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- /.box -->
            <div class="box">
                <section class="content-header">
                    <h1 class=" col-xs-12 text-center">
                        <strong class="text-uppercase">Usuários</strong> - <em>Listagem</em>
                    </h1>
                </section>
                <hr class="col-xs-12"/>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php
                    if ($msg = get_msg()) {
                        echo $msg;
                    }
                    if (isset($users) && sizeof($users) > 0) { ?>

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Login</th>
                                    <th>E-mail</th>
                                    <th>Telefone</th>
                                    <th>Tipo Usuário</th>
                                    <th>Bloqueado</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $index = true ?>
                                <?php foreach ($users as $user) { ?>
                                    <?php if ($index) { } ?>
                                    <tr class="<?php if (isset($user->blocked) && $user->blocked) echo 'inative' ?>">
                                        <td><?php if (isset($user->first_name)) echo $user->first_name ?></td>
                                        <td><?php if (isset($user->login)) echo $user->login ?></td>
                                        <td><?php if (isset($user->email)) echo $user->email ?></td>
                                        <td><?php if (isset($user->phone)) echo $user->phone ?></td>
                                        <td><?php if (isset($user->permission_name)) echo $user->permission_name ?></td>
                                        <td><?php if (isset($user->blocked)) if ($user->blocked) {
                                                echo "Bloqueado";
                                            } else {
                                                echo "Ativo";
                                            } ?></td>
                                        <td>
                                            <?php if (isset($user->ID)) {
                                                $userId = $user->ID;
                                                $userBlocked = $user->blocked;
                                                if ($userBlocked) {
                                                    $userBlocked = 'fa fa-lock';
                                                } else {
                                                    $userBlocked = 'fa fa-unlock';
                                                }

                                                $disable = (isRoot($user->permission_value)) ?  "disabled" : '';
                                                $title_blocked = ($user->blocked) ? "Desbloquear" : "Bloquear";

                                                if (!isRoot($user->permission_value) || AmIRoot()) {
                                                    ?>
                                                    <a href="<?php echo base_url('admin/users/blocker/' . $userId) ?>" class="btn btn-small btn-danger <?php echo $disable; ?>" title="<?php echo $title_blocked ?>">
                                                        <i class="<?php echo $userBlocked ?>"></i>
                                                    </a>
                                                    <a href="<?php echo base_url('admin/users/editar/' . $userId) ?>" class="btn btn-small btn-info" title="Editar">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                <?php } else {
                                                ?>
                                                    <a href="<?php echo base_url('admin/users/blocker/' . $userId) ?>" class="btn btn-small btn-danger <?php echo $disable; ?>" title="<?php echo $title_blocked ?>">
                                                        <i class="<?php echo $userBlocked ?>"></i>
                                                    </a>
                                                    <a href="<?php echo base_url('admin/users/editar/' . $userId) ?>" class="btn btn-small btn-info" title="Editar">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                <?php
                                            } ?>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <tfoot>
                                <tr>
                                    <th>Nome</th>
                                    <th>Login</th>
                                    <th>E-mail</th>
                                    <th>Telefone</th>
                                    <th>Tipo Usuário</th>
                                    <th>Bloqueado</th>
                                    <th>Ações</th>
                                </tr>
                            </tfoot>
                        </table>
                    <?php } ?>
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