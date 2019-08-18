<div class="reo">
    <ul id="myBreadcrumb" class=" col-xs-12">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i></a></li>
        <?php
        if (isset($breadcrumb)) {

            for ($i = 0; $i < sizeof($breadcrumb); $i++) {
                $rota = $breadcrumb[$i]['rota'];
                $titulo = $breadcrumb[$i]['titulo'];
                if (strlen($titulo) >= 20) $titulo = substr($titulo, 0, 16) . " ... ";

                if ($i !== (sizeof($breadcrumb)-1 ))
                    echo '<li><a href="' . base_url($rota) . '">' . $titulo . '</a></li>';
                else
                    echo '<li>' . $titulo . '</li>';
            }
        }
        ?>
    </ul>
</div>