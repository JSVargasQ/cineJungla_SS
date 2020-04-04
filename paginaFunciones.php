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
    Now UI Dashboard by Creative Tim
  </title>
    <?php require_once "./scripts.php";

    require_once "./clases/conexion.php";
    $obj=new conectar();
    $conexion=$obj->conexion();

    $cod_mul = 2;
    
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
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
          CJ
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          CINE JUNGLA APP
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="../dashboard.html">
              <i class="now-ui-icons design_app"></i>
              <p>FUNCIONES</p>
            </a>
          </li>
          <li>
            <a href="./icons.html">
              <i class="now-ui-icons education_atom"></i>
              <p>ALIMENTOS Y BEBIDAS</p>
            </a>
          </li>
          <li>
            <a href="./map.html">
              <i class="now-ui-icons location_map-big"></i>
              <p>PELICULAS</p>
            </a>
          </li>
          <li>
            <a href="./notifications.html">
              <i class="now-ui-icons ui-1_bell-53"></i>
              <p>INGRESAR CLIENTE</p>
            </a>
          </li>
          <li>
            <a href="./user.html">
              <i class="now-ui-icons users_single-02"></i>
              <p>REGISTRAR CLIENTE</p>
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
            <a class="navbar-brand" style="font-size:3 ">FUNCIONES</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="now-ui-icons media-2_sound-wave"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons location_world"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
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
                TABLA PRODUCTOS
              </div>
              <div class="card-body">

                <span class="btn btn-primary" data-target="#agregarFuncion"  data-toggle="modal"> Añadir función  <i class="fas fa-film"></i>
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

  

<!-- Modal -->
<div class="modal fade" id="agregarFuncion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar función</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formFuncion" >

            <table>
              <tr>
                <td>
                  <label>Pelicula:</label>     
                </td>

                <td>     
                  <select name="pelicula" id="pelicula">

                    <?php 
                      $sql = "SELECT cod_pelicula, nombre_pelicula FROM PELICULA";
                      $result=mysqli_query($conexion,$sql);

                      while( $pelicula = mysqli_fetch_row($result) )
                      {
                          echo "<option value=$pelicula[0]>$pelicula[1]</option>"; 
                      }
                    ?>
                  </select>
                </td>
              </tr>

              <tr>
                <td>
                  <label>Sala:</label>     
                </td>

                <td>     
                  <select name="sala" id="sala">

                    <?php 
                      $sql = "SELECT cod_sala_cine, nombre_sala FROM SALA_CINE WHERE SALA_CINE.cod_multiplex=$cod_mul";
                      $result=mysqli_query($conexion,$sql);

                      while( $sala = mysqli_fetch_row($result) )
                  {
                      echo "<option value=$sala[0]>$sala[1]</option>"; 
                  }
                    ?>
                  </select>
                </td>
              </tr>


              <tr>
                <td>
                  <label>Fecha:</label>     
                </td>

                <td>     
                  <input type="DATE" id="fecha" name="fecha">
                </td>
              </tr>


              <tr>
                <td>
                  <label>Hora:</label>     
                </td>

                <td>     
                  <input type="TIME" id="hora" name="hora">
                </td>
              </tr>
              
              <tr>
                <td>
                  <label>Dias de proyección:</label>     
                </td>

                <td>     
                  <input type="number" values="1" min="0" max="365" id="dias" name="dias">
                </td>
              </tr>

            </table>
        </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btnAgregarFuncion" class="btn btn-primary">Agregar</button>
      </div>
    </div>
  </div>
</div>

</body>

</html>

<script type="text/javascript">
  $(document).ready(function(){
    $('#btnAgregarFuncion').click(function(){
      datos=$('#formFuncion').serialize();

    $.ajax({
        type:"POST",
        data:datos,
        url:"procesos/insertarFuncion.php",
        success:function(r){
          if(r==1){
            $('#formFuncion')[0].reset();
            alertify.success("Agregado con exito.");
            $('#tabladatatable').load('tablaFunciones.php');
          }
          else{
            alertify.error("No se pudo agregar la función.");
          }
        }
      }); 

    });
  });


</script>
            


<script type="text/javascript">
  $(document).ready(function(){
    $('#tabladatatable').load('tablaFunciones.php');
  });


</script>