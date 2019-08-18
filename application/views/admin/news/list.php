<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- /.box -->
            <div class="box">
                <section class="content-header">
                    <h1 class=" col-xs-12 text-center">
                        <strong class="text-uppercase">Notícias</strong> - <em>Listagem</em>
                    </h1>
                </section>
                <hr />
                <!-- /.box-header -->

                <div class=" box-body">
                    <?php
                    if ($msg = get_msg()) { echo $msg; }
                    if (isset($news) && sizeof($news) > 0) { ?>

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Título</th>
                                    <th class="text-center">Publicada</th>
                                    <th class="text-center">Destaque</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($news as $single_news) { ?>
                                    <tr>
                                        <td class="col-xs-12"><?php if (isset($single_news->news_title)) echo $single_news->news_title ?></td>
                                        <td>
                                            <?php if (isset($single_news->news_published)) {

                                                $news_published_title  = "Publicada";
                                                $news_published_class  = "success";

                                                if ($single_news->news_published) {
                                                    $news_published_title = "Despublicada";
                                                    $news_published_class = "danger";
                                                } ?>
                                                <a href="<?php echo base_url('admin/news/changestatus/' . $single_news->ID ) ?>" class="btn btn-<?php echo $news_published_class ?>">
                                                    <?php echo $news_published_title ?>
                                                </a>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if (isset($single_news->news_highlight)) {

                                                $news_highlight_title  = "Destaque";
                                                $news_highlight_class  = "warning";

                                                if ($single_news->news_highlight) {
                                                    $news_highlight_title = "Normal";
                                                    $news_highlight_class = "default";
                                                } ?>
                                            <a href="<?php echo base_url('admin/news/highlighter/' . $single_news->ID ) ?>" class="btn btn-<?php echo $news_highlight_class ?>">
                                                <?php echo $news_highlight_title ?>
                                            </a>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url('admin/news/editar/' . $single_news->ID ) ?>" class="btn btn-small btn-info" title="Editar">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            <?php } ?>

                                        </td>
                                    </tr>
                                <?php } ?>
                            <tfoot>
                                <tr>
                                    <th>Título</th>
                                    <th class="text-center">Publicada</th>
                                    <th class="text-center">Destaque</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </tfoot>
                        </table>
                    <?php } else { ?>
                        <p>Nenhuma notícia cadastrada</p>
                        <a href="<?php echo base_url('admin/news/cadastrar') ?>" class="btn btn-success">Cadastrar Notícias</a>
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