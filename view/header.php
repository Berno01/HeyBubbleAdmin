<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HeyBubble-Admin</title>
    <link href="../public/vendors/select2/select2.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="../public/images/logo/iconpage.jpg">

    <!-- page css -->
    <link href="../public/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">

    <!-- Core css -->
    <link href="../public/css/app.min.css" rel="stylesheet">

    <!-- Sweet Alert-->
    <link href="../public/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            <div class="header">
                <div class="logo logo-dark">
                    <a href="view/index.html">
                        <img src="../public/images/logo/logoHeyBubble.jpeg" alt="Logo">
                        <img class="logo-fold" src="../public/images/logo/logoHeyBubble.jpeg" alt="Logo">
                    </a>
                </div>
                <div class="logo logo-white">
                    <a href="view/index.html">
                        <img src="../public/images/logo/logoHeyBubble.jpeg" alt="Logo">
                        <img class="logo-fold" src="../public/images/logo/logoHeyBubble.jpeg" alt="Logo">
                    </a>
                </div>
                <div class="nav-wrap">
                    <ul class="nav-left">
                        
                    </ul>
                    <ul class="nav-right">
                        <li class="dropdown dropdown-animated scale-left">
                            <a href="javascript:void(0);" data-toggle="dropdown">
                            <i class="fa-solid fa-glass-water"></i>
                            </a>
                            <div class="dropdown-menu pop-notification">
                                <div class="p-v-15 p-h-25 border-bottom d-flex justify-content-between align-items-center">
                                    <p class="text-dark font-weight-semibold m-b-0">
                                        <i class="anticon anticon-bell"></i>
                                        <span class="m-l-10">Crea todo lo necesario para vender</span>
                                    </p>
                                </div>

                                <div class="relative">
                                    <div class="overflow-y-auto relative scrollable" style="max-height: 300px">
                                        <a href="sabor.php" class="dropdown-item d-block p-15 border-bottom">
                                            <div class="d-flex">
                                                <div class="avatar avatar-blue avatar-icon">
                                                <i class="fa-solid fa-blender"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <p class="m-b-0 text-dark">Administrar sabores</p>
                                                    
                                                </div>
                                            </div>
                                        </a>
                                        <a href="tamanio.php" class="dropdown-item d-block p-15 border-bottom">
                                            <div class="d-flex">
                                                <div class="avatar avatar-cyan avatar-icon">
                                                <i class="fa-solid fa-whiskey-glass"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <p class="m-b-0 text-dark">Administrar Vasos</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="buba.php" class="dropdown-item d-block p-15 border-bottom">
                                            <div class="d-flex">
                                                <div class="avatar avatar-cyan avatar-icon">
                                                <i class="fa-solid fa-bowl-rice"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <p class="m-b-0 text-dark">Administrar Bubas</p>
                                                </div>
                                            </div>
                                        </a>
                                        
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="dropdown dropdown-animated scale-left">
                            <a href="javascript:void(0);" data-toggle="dropdown">
                            <i class="fa-solid fa-store"></i>
                            </a>
                            <div class="dropdown-menu pop-notification">
                                <div class="relative">
                                    <div class="overflow-y-auto relative scrollable" style="max-height: 300px">
                                        <a href="venta1.php" class="dropdown-item d-block p-15 border-bottom">
                                            <div class="d-flex">
                                                <div class="avatar avatar-blue avatar-icon">
                                                <i class="fa-solid fa-cash-register"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <p class="m-b-0 text-dark">Vender</p>
                                                    
                                                </div>
                                            </div>
                                        </a>
                                        <a href="venta.php" class="dropdown-item d-block p-15 border-bottom">
                                            <div class="d-flex">
                                                <div class="avatar avatar-cyan avatar-icon">
                                                <i class="fa-solid fa-book"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <p class="m-b-0 text-dark">Ver Historial</p>
                                                </div>
                                            </div>
                                        </a>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="dropdown dropdown-animated scale-left">
                            <a href="inventario.php">
                            <i class="fa-solid fa-box-open"></i>
                            </a>
                            
                        </li>

                        
                        
                    </ul>
                </div>
            </div>    
            <!-- Header END -->

            
            <!-- Page Container <div class="page-container"> START -->
            
             
            <!-- Content Wrapper START -->
            <div class="main-content">