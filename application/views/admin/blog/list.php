

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- /.box -->
            <div class="box">
                <section class="content-header">
                    <h1 class=" col-xs-12 text-center">
                        <strong class="text-uppercase">Blog</strong> - <em>Listagem</em>
                    </h1>
                </section>
                <hr />
                <!-- /.box-header -->

                <div class=" box-body">
                    <?php
                    if ($msg = get_msg()) {
                        echo $msg;
                    }
                    if (isset($blog) && sizeof($blog) > 0) { ?>

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Título</th>
                                    <th class="text-center">Publicada</th>
                                    <th class="text-center">Data de Publicação</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($blog as $single_blog) { ?>
                                    <tr>
                                        <td class="col-xs-12">
                                        <a href="<?php echo base_url('admin/blog/editar/' . $single_blog->ID) ?>" class="" title="Editar">        
                                        <?php if (isset($single_blog->blog_title)) echo $single_blog->blog_title ?>
                                    </a>
                                        </td>
                                        <td>
                                            <?php if (isset($single_blog->blog_published)) {
                                                $blog_published_title  = "Publicada";
                                                $blog_published_class  = "success";
                                                if ($single_blog->blog_published) {
                                                    $blog_published_title = "Despublicada";
                                                    $blog_published_class = "danger";
                                                } ?>
                                                <a href="<?php echo base_url('admin/blog/changestatus/' . $single_blog->ID) ?>" class="btn btn-<?php echo $blog_published_class ?>">
                                                    <?php echo $blog_published_title ?>
                                                </a>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if (isset($single_blog->blog_date_to_publish)) echo $single_blog->blog_date_to_publish; ?>

                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('admin/blog/editar/' . $single_blog->ID) ?>" class="btn btn-small btn-info" title="Editar">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <tfoot>
                                <tr>
                                    <th>Título</th>
                                    <th class="text-center">Publicada</th>
                                    <th class="text-center">Data de Publicação</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </tfoot>
                        </table>
                    <?php } else { ?>
                        <p>Nenhuma notícia cadastrada</p>
                        <a href="<?php echo base_url('admin/blog/cadastrar') ?>" class="btn btn-success">Cadastrar Notícias</a>
                    <?php }  ?>
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