<!--

=========================================================
* Now UI Dashboard - v1.5.0
=========================================================

* Product Page: https://www.creative-tim.com/product/now-ui-dashboard
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Designed by www.invisionapp.com Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    ADMINISTRADOR LOCAL
  </title>
  <?php
    require_once "scripts.php";
    require_once "clases/conexion.php";
    include_once 'controlador/user.php';
    include_once 'controlador/user_Sesion.php';
    
    $obj=new conectar();
    $conexion=$obj->conexion();
    
    $userSession = new UserSession();
    $user = new Usuario();
    
    if(!isset($_SESSION['user']))
    {
        header("location: index.php");
    }
    
    $user->setUser($userSession->getCurrentUser());
    $cod_mul = $user->getCodigoMul();
    $nom_mul = $user->getNomMul();
    $cod_usuario = $user->getCodUsuario();
    $nom_c_empleado = $user->getNomTUsuario();
    $host= gethostname();
    $ip = gethostbyname($host);
    
    $sql = "insert into AUDITORIA (cod_usuario, nombre_cargo_empleado, accion, nombre_tabla, fecha_modificacion, ip_modificacion) values (".$cod_usuario.", '".$nom_c_empleado."', 'Read', 'Snacks', now(),'".$ip."');";
    $result=mysqli_query($conexion,$sql);
    ?>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
 
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
    <div class="logo">
        <a href="A_paginaIndex.php" class="simple-text logo-mini">
          CJ
        </a>
        <a href="A_paginaIndex.php" class="simple-text logo-normal">
          CINE JUNGLA APP
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="A_paginaFunciones.php">
              <i class="fas fa-film"></i>
              <p>GESTI&Oacute;N DE FUNCIONES</p>
            </a>
          </li>
          <li>
            <a href="A_paginaSnacks.php">
              <i class="fas fa-hotdog">
              </i>
              <p>GESTI&Oacute;N DE SNACKS</p>
            </a>
          </li>
          <li>
            <a href="A_paginaSalas.php">
              <i class="fas fa-couch"></i>
              <p>GESTI&Oacute;N DE SALAS</p>
            </a>
          </li>
          <li>
            <a href="A_paginaEmpleados.php">
              <i class="now-ui-icons users_single-02"></i>
              <p>GESTI&Oacute;N DE EMPLEADOS</p>
            </a>
          </li>
          <li>
            <a href="A_paginaAuditoria.php">
              <i class="now-ui-icons ui-1_bell-53"></i>
              <p>AUDITORIA</p>
            </a>
          </li>
          <li>
            <a href="A_paginaReportes.php">
              <i class="fas fa-book"></i>
              <p>REPORTES</p>
            </a>
          </li>


        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" style="font-size:3 ">
            <?php 
                    echo "MULTIPLEX ". $nom_mul;
                ?></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#sergio">
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Usuario</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="controlador/logout.php">Cerrar sesi&oacute;n</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- End Navbar -->

      <div>
      <div class="content">
        <div class="container-fluid ">
        <div class="row">
          <div class="col-sm-12">
            <div class="card text-left">
              <div class="card-header">
                TABLA SNACKS
              </div>
              <div class="card-body">
                <span class="btn btn-info" data-toggle="modal" data-target="#agregarSnack"> Agregar snack <i class="fas fa-hotdog"></i>
                </span>
               

                <hr>
                <div id="tabladatatable">



                </div>


              </hr>
            </div>
            <div class="card-footer text-muted">
              BY CINEJUNGLA APP
            </div>
          </div>
        </div>

      </div>
      </div>
      <footer class="footer">
        <div class=" container-fluid ">
          <nav>
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  GRUPO DE DESARROLLO UEB SOFTWARE
                </a>
              </li>

              <li>
                <a href="http://blog.creative-tim.com">
                  Blog
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright" id="copyright">
            &copy; <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>, Designed by UEBGRUPOB. Coded by <a href="https://www.creative-tim.com" target="_blank">EQUPIO COMPLETO</a>.
          </div>
        </div>
      </footer>
    </div>
    </div>
  </div>
  
  <div class="modal fade" id="agregarSnack" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar snack</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formSnack">
        <table>
          <tr>
            <input type="hidden" name="almacen" id="almacen" value='<?php echo $cod_mul ?>'>
            <input type="hidden" name="multiplex" id="multiplex" value='<?php echo $nom_mul ?>'>
            <td><label>Snack:</label></td>
            <td><select name="codigo" id="codigo">

                    <?php 
                      $sql = "SELECT codigo_producto, producto FROM cantidad_almacen";
                      $result=mysqli_query($conexion,$sql);

                      while( $codSnack = mysqli_fetch_row($result) )
                  {
                      echo "<option value=$codSnack[0]>$codSnack[1]</option>"; 
                  }
                    ?>
                  </select></td>
          </tr>
          
          <tr>
            <td><label>Cantidad</label></td>
            <td><input type="number" name="cantidad" id="cantidad" min="10" max=100/></td>
          </tr>

        </table>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btnAgregarSnack" class="btn btn-success">Agregar</button>
      </div>
    </div>
  </div>
</div>
  
</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){
    $('#btnAgregarSnack').click(function(){
      datos=$('#formSnack').serialize();
      console.log(datos);
    $.ajax({
        type:"POST",
        data:datos,
        url:"procesos/agregarSnack.php",
        success:function(r){
          console.log(r);
          if(r==1){
            $('#formSnack')[0].reset();
            alertify.success("Agregado con exito.");
            $('#tabladatatable').load('A_tablaSnacks.php');
          }
          else{
            alertify.error("No se pudo agregar el snack");
          }
        }
      }); 

    });
  });

  </script>
  
<script type="text/javascript">
  $(document).ready(function()
	{
    $('#tabladatatable').load('A_tablaSnacks.php')
  });


</script>