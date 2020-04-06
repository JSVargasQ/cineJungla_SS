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
    $cod_usuario = $user->getCodUsuario();
    $nom_c_empleado = $user->getNomTUsuario();
    $host= gethostname();
    $ip = gethostbyname($host);
    
    $sql = "insert into AUDITORIA (cod_usuario, nombre_cargo_empleado, accion, nombre_tabla, fecha_modificacion, ip_modificacion) values (".$cod_usuario.", '".$nom_c_empleado."', 'Read', 'Funciones', now(),'".$ip."');";
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
                $conexion=$obj->conexion();
                $sql="SELECT nom_multiplex FROM MULTIPLEX where MULTIPLEX.cod_multiplex = $cod_mul";
                $result=mysqli_query($conexion,$sql);
                
                while($row = $result->fetch_assoc())
                {
                    echo "MULTIPLEX ". $row['nom_multiplex'];
                }
            ?>
            </a>
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
                TABLA PRODUCTOS
              </div>
              <div class="card-body">

                <span class="btn btn-success" data-target="#agregarFuncion"  data-toggle="modal"> Añadir función  <i class="fas fa-film"></i>
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

  

<!-- Modal INSERT -->
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
                      $sql = "SELECT cod_pelicula, nombre_pelicula FROM PELICULA WHERE estado_pelicula='ACTIVO'";
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
                      $cod_mul = 2;
                      $sql = "SELECT cod_sala_cine, nombre_sala FROM SALA_CINE WHERE SALA_CINE.cod_multiplex=".$cod_mul." AND SALA_CINE.estado_sala='ACTIVO'";
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
                  <input type="DATE" id="fecha" name="fecha" min= <?php echo date('Y-m-d'); ?>    >
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
                  <input type="number" values="1" min="1" max="365" id="dias" name="dias">
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


<!-- Modal UPDATE-->
<div class="modal fade" id="updateFuncion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar función</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formFuncionU" >

            <table>
              

                <input type="hidden" value="" name="multiplexU" id="multiplexU">
                <input type="hidden" value="" name="cod_funcionU" id="cod_funcionU">


              <tr>
                <td>
                  <label>Pelicula:</label>     
                </td>

                <td>     
                  <select name="peliculaU" id="peliculaU">

                    <?php 
                      $sql = "SELECT cod_pelicula, nombre_pelicula FROM PELICULA WHERE estado_pelicula='ACTIVO'";
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
                  <select name="salaU" id="salaU">

                    <?php 
                      $sql = "SELECT cod_sala_cine, nombre_sala FROM SALA_CINE WHERE SALA_CINE.cod_multiplex=".$cod_mul." AND SALA_CINE.estado_sala='ACTIVO'";
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
                  <input type="DATE" id="fechaU" name="fechaU" min= <?php echo date('Y-m-d'); ?>    >
                </td>
              </tr>


              <tr>
                <td>
                  <label>Hora:</label>     
                </td>

                <td>     
                  <input type="TIME" id="horaU" name="horaU">
                </td>
              </tr>

            </table>
        </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btnActualizarFuncion" class="btn btn-primary">Actualizar</button>
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
            $('#tabladatatable').load('A_tablaFunciones.php');
          }
          else{
            alertify.error("No se pudo agregar la función.");
          }
        }
      }); 

    });

    $('#btnActualizarFuncion').click(function(){

      datos=$('#formFuncionU').serialize();

      $.ajax({
        type:"POST",
        data:datos,
        url:"procesos/actualizarFuncion.php",
        success:function(r){
          if(r==1){
            $('#formFuncionU')[0].reset();
            alertify.success("Función actualizada con exito.");
            $('#tabladatatable').load('A_tablaFunciones.php');
          }
          else{
            alertify.error("No se pudo actualizar la función.");
          }
        }
      }); 

    });


  });

</script>
            


<script type="text/javascript">
  $(document).ready(function(){
    $('#tabladatatable').load('A_tablaFunciones.php');
  });


</script>

<script type="text/javascript">
  function agregarFormActualizar(cod_funcion, cod_mul){

    var parametros = {
                "cod_funcion" : cod_funcion,
                "cod_multiplex" : cod_mul
        };

    $.ajax({

      type:"POST",
      data:parametros,
      url:"procesos/obtenerDatosFuncion.php",
      success:function(r){

      datos=jQuery.parseJSON(r);

      $('#peliculaU').val(datos['cod_pelicula']);
      $('#salaU').val(datos['cod_sala']);
      $('#fechaU').val(datos['fecha']);
      $('#horaU').val(datos['hora']);
      $('#multiplexU').val(datos['multiplex']);
      $('#cod_funcionU').val(datos['cod_funcion']);
      
      }

    });

  }

  function eliminarFuncion(pCodFuncion, pCodMultiplex){

  alertify.confirm('Eliminar empleado', '¿Seguro de eliminar esta función?', 
        function(){ 
          var parametros = {
              "cod_funcion" : pCodFuncion,
              "cod_multiplex" : pCodMultiplex 
          };

          $.ajax({

          type:"POST",
          data:parametros,
          url:"procesos/eliminarFuncion.php",
          success:function(r){
            console.log(r);
            if(r==1){

              alertify.success("Se ha eliminado la función");
              $('#tabladatatable').load('A_tablaFunciones.php');
            }else{
              alertify.error("No se ha podido eliminar");
            }

          }

          });
        }, 
        function(){ 
          
        });
}
</script>