<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Logo -->
                <a href="./home" class="logo">
                    <!-- mini logo -->    
                    <span class="logo-mini"><b>CeAprende</b></span>    
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo"><b>CeAprende</b>Compartilhando e Aprendendo</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo base_url('dist/img/user2-160x160.jpg'); ?> " class="user-image" alt="User Image">
                                <span class="hidden-xs">Alexandre Pontes</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?php echo base_url('dist/img/user2-160x160.jpg'); ?> " class="img-circle" alt="User Image">

                                    <p>
                                        Alexandre Pontes - Analista de TI
                                        <small>Setor de Infraestrutura</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="<?php echo base_url('logout') ?>" class="btn btn-default btn-flat">Sair</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                       
                    </ul>
                </div>
            </nav>
        </header>

        

        <?php
        $menuActiveAux = [];
        if (isset($menuActive)){
            $menuActiveAux['menuActive'] = $menuActive;
        }
        if(isset($asidecadastar)) {
            $this->load->view('admin/includes/navbar-aside', $menuActiveAux);
        }
         ?>
        <div class="content-wrapper">
        <div class="spinner-area">
            <div class="spinner"><i class="fa fa-spinner anim-rotate"></i></div>
        </div>