<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" rel="stylesheet">
    @notify_css
    
    <!-- Scripts -->
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    @notify_js
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->

    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/receita-despesa.js') }}"></script>
    <script src="{{ asset('js/funcionalidades.js') }}"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/home') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-address-card"></i>
                </div>
                <div class="sidebar-brand-text mx-3">IMPEKABLE</div>
            </a>

            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link " href="{{ url('/categorias') }}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Categorias</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="{{ url('/cartoes_credito') }}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Cartões de crédito</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="{{ url('/metas_orcamentarias') }}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Metas</span>
                </a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                    aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Lançamentos</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ url('/receitas') }}">Receitas</a>
                    <a class="collapse-item" href="{{ url('/despesas') }}">Despesas</a>
                    </div>
                </div>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                        <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#perfilModal">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Perfil
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Configurações
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Log de Atividades
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                        </div>
                    </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Sistema de Gestão Financeira IMPEKABLE 2019</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pronto para partir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecione "Logout" abaixo se você estiver pronto para terminar sua sessão atual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

     <!-- Perfil Modal -->
     <div class="modal fade" id="perfilModal" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-perfil">Perfil</h5>
                <button class="close" id="btn-editar">
                    <span aria-hidden="true">
                        <i class="fas fa-user-edit"></i>
                    </span>
                </button>
                <button id="cancelar" type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">
                        <i class="fas fa-times-circle"></i>
                    </span>
                </button>
            </div>
            <form action="{{ route('user.store') }}" method="POST">
                <div class="modal-body">
                     @csrf
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="nome">Nome</label><input
                                     class="form-control" type="text" name="name"
                                     placeholder="Nome" value="{{ Auth::user()->name }}" disabled>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="email">Email</label><input
                                     class="form-control" type="text"
                                     name="email" placeholder="Email" value="{{ Auth::user()->email }}" disabled>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="cpf">CPF</label><input
                                     class="form-control" type="text" name="cpf"
                                     placeholder="CPF" value="{{ Auth::user()->cpf }}" disabled>  
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="rg">RG</label><input
                                     class="form-control" type="text" name="rg"
                                     placeholder="RG" value="{{ Auth::user()->rg }}" disabled>
                             </div>
                         </div>
                         <div class="col-md-9">
                             <div class="form-group">
                                 <label for="endereco">Endereço</label><input
                                     class="form-control" type="text" value="{{ Auth::user()->endereco }}"
                                     name="endereco" placeholder="Endereço" disabled>
                             </div>
                         </div>
                         <div class="col-md-3">
                             <div class="form-group">
                                 <label for="numero-casa">Data de nascimento
                                 </label><input class="form-control" type="date"
                                     name="dataNascimento"  value="{{ Auth::user()->dataNascimento }}" disabled>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="bairro">Bairro</label><input
                                     class="form-control" type="text" value="{{ Auth::user()->bairro }}"
                                     name="bairro" placeholder="Bairro" disabled>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group">
                                 <label for="cidade">Cidade</label><input
                                     class="form-control" type="text" value="{{ Auth::user()->cidade }}"
                                     placeholder="Cidade" name="cidade" disabled>
                             </div>
                         </div>
                         <div class="col-md-2">
                             <div class="form-group">
                                 <label for="numero">Numero</label><input
                                     class="form-control" type="text" value="{{ Auth::user()->numero }}"
                                     placeholder="numero" name="numero" disabled>
                             </div>
                         </div>
                     </div>
                </div>
                <div class="modal-footer">
                    <button id="salvar" type="submit" class="btn btn-success" disabled>
                        <i class="fas fa-save"></i>
                        Salvar as alterações
                    </button>
                </div>
            </form>
         </div>
     </div>

</body> 

@notify_render

</html>
