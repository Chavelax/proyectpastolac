<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="?admin=principal1">
                <img src="./fotos/logo.png" alt="logo" class="logo-default" /> </a>
            <div class="menu-toggler sidebar-toggler"> </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN NOTIFICATION DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->


                <!-- END USER LOGIN DROPDOWN -->
                <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-quick-sidebar-toggler">
                    <a href="./logout.php" onclick="window.location = './logout.php'" class="dropdown-toggle">
                        <i class="icon-logout"></i>
                    </a>
                </li>
                <!-- END QUICK SIDEBAR TOGGLER -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>

<div class="page-container">

    <div class="page-sidebar-wrapper">

        <div class="page-sidebar navbar-collapse collapse">

            <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                <li class="sidebar-toggler-wrapper hide">
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <div class="sidebar-toggler"> </div>
                    <!-- END SIDEBAR TOGGLER BUTTON -->
                </li>


                <li class="nav-item start active open">
                    <a href="?admin=principal1" class="nav-link nav-toggle">
                        <i class="icon-wrench"></i>
                        <span class="title">Administracion</span>
                        <span class="selected"></span>
                        <span class="arrow open"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item start ">
                            <a href="?admin=principal1" class="nav-link ">
                                <i class="fa fa-home"></i>
                                <span class="title">INICIO</span>

                            </a>
                        </li>

                        <li class="nav-item start ">
                            <a href="#" class="nav-link nav-toggle">
                                <i class="fa fa-truck"></i>
                                <span class="title">Materia Prima</span>
                                <span class="selected"></span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item start ">
                                    <a href="?admin=MateriaPri" class="nav-link ">
                                        <i class="fa fa-truck"></i>
                                        <span class="title">Lista de Materia Prima</span>
                                    </a>
                                </li>
                                <li class="nav-item start ">
                                    <a href="?admin=entradaM" class="nav-link ">
                                        <i class="fa fa-search-plus"></i>
                                        <span class="title">Entradas de Materia Prima</span>

                                    </a>
                                </li>
                                <li class="nav-item start ">
                                    <a href="?admin=salidaM" class="nav-link ">
                                        <i class="fa fa-search-plus"></i>
                                        <span class="title">Salida de Materia Prima</span>

                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item start ">
                            <a href="#" class="nav-link nav-toggle">
                                <i class="fa fa-barcode"></i>
                                <span class="title">Productos Elaborados</span>
                                <span class="selected"></span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item start ">
                                    <a href="?admin=productos" class="nav-link ">
                                        <i class="fa fa-barcode"></i>

                                        <span class="title">Lista de Productos Elaborados</span>
                                    </a>
                                </li>
                                <li class="nav-item start ">
                                    <a href="?admin=entradas" class="nav-link ">
                                        <i class="fa fa-search-plus"></i>
                                        <span class="title">Entradas de Productos Elaborados</span>

                                    </a>
                                </li>
                                <li class="nav-item start ">
                                    <a href="?admin=salida" class="nav-link ">
                                        <i class="fa fa-search-plus"></i>
                                        <span class="title">Salida de Productos Elaborados</span>

                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item start ">
                            <a href="#" class="nav-link nav-toggle">
                                <i class="fa fa-wrench"></i>
                                <span class="title">Configuración</span>
                                <span class="selected"></span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item start ">
                                    <a href="?admin=usuario" class="nav-link ">
                                        <i class="fa fa-child"></i>
                                        <span class="title">Usuarios</span>
                                    </a>
                                </li>
                                <li class="nav-item start ">
                                    <a href="?admin=pag" class="nav-link ">
                                        <i class="fa fa-television"></i>
                                        <span class="title">Pagina Web</span>

                                    </a>
                                </li>
                            </ul>
                        </li>



                    </ul>
                </li>

            </ul>
            <!-- END SIDEBAR MENU -->
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">