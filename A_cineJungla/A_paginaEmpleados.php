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
    
    $sql = "insert into AUDITORIA (cod_usuario, nombre_cargo_empleado, accion, nombre_tabla, fecha_modificacion, ip_modificacion) values (".$cod_usuario.", '".$nom_c_empleado."', 'Read', 'Empleados', now(),'".$ip."');";
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
                <span class="btn btn-info" data-toggle="modal" data-target="#agregarEmpleado"> Agregar empleado <i class="fas fa-user-plus"></i>
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



<!-- Modal INSERT-->
<div class="modal fade" id="agregarEmpleado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar empleado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEmpleado">
        <table>
          <tr>
            <td><label>Nombre:</label></td>
            <td><input type="text" id="nombre" name="nombre" required ></td>
          </tr>

          <tr>
            <td><input type="hidden"></td>
            <td><input type="hidden" id="multiplex" name="multiplex" <?php echo $cod_mul ?>></td>
          </tr>

          <tr>
            <td><label>Salario:</label></td>
            <td><input type="number" id="salario" values="1" min="0" name="salario"></td>
          </tr>

          <tr>
            <td><label>Cod usuario:</label></td>
            <td><input type="number" id="cod" values="1" min="0" name="cod"></td>
          </tr>

          <tr>
            <td><label>Tipo:</label></td>
            <td><select name="tipo" id="tipo">

                    <?php 
                      $sql = "SELECT cod_tipo_empleado, nombre_cargo_empleado FROM cargo_empleado  WHERE cod_tipo_empleado != 1 AND cod_tipo_empleado != 6";
                      $result=mysqli_query($conexion,$sql);

                      while( $cargoEmpl = mysqli_fetch_row($result) )
                  {
                      echo "<option value=$cargoEmpl[0]>$cargoEmpl[1]</option>"; 
                  }
                    ?>
                  </select></td>

          </tr>

          <tr>
            <td><label>Correo:</label></td>
            <td><input type="text" id="correo"  name="correo"></td>
          </tr>

            <td><label>Fecha de ingreso:</label></td>
            <td><input type="DATE" id="fecha" name="fecha"></td>

        </table>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btnAgregarNuevo" class="btn btn-primary">Agregar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal UPDATE-->
<div class="modal fade" id="actualizarEmpleados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar empleado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEmpleadoU">
        <table>

          <tr>
            <td><input type="hidden" id="cod_empleadoU" name="cod_empleadoU" value=""></td>
          </tr>

          <tr>
            <td><label>Nombre:</label></td>
            <td><input type="text" id="nombreU" name="nombreU" required ></td>
          </tr>

          <tr>
            <td><label>Salario:</label></td>
            <td><input type="number" id="salarioU" values="1" min="0" name="salarioU"></td>
          </tr>



          <tr>
            <td><label>Tipo:</label></td>
            <td><select name="tipoU" id="tipoU">

                    <?php 
                      $sql = "SELECT cod_tipo_empleado, nombre_cargo_empleado FROM cargo_empleado WHERE cod_tipo_empleado != 1 AND cod_tipo_empleado != 6";
                      $result=mysqli_query($conexion,$sql);

                      while( $cargoEmpl = mysqli_fetch_row($result) )
                  {  
                      echo "<option value=$cargoEmpl[0]>$cargoEmpl[1]</option>"; 
                  }
                    ?>
                  </select></td>

          </tr>

          <tr>
            <td><label>Correo:</label></td>
            <td><input type="text" id="correoU"  name="correoU"></td>
          </tr>

        </table>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btnActualizarEmpleado" class="btn btn-primary">Actualizar</button>
      </div>
    </div>
  </div>
</div>



</body>

</html>


<script type="text/javascript">
  $(document).ready(function(){

    $('#btnAgregarNuevo').click(function(){
      datos=$('#formEmpleado').serialize();

    $.ajax({
        type:"POST",
        data:datos,
        url:"procesos/agregarEmpleado.php",
        success:function(r){
          if(r==1){
            $('#formEmpleado')[0].reset();
            alertify.success("Agregado con exito.");
            $('#tabladatatable').load('A_tablas/A_tablaEmpleados.php');
          }
          
          else{
            alertify.error("No se pudo agregar el empleado");
          }
        }
      }); 

    });



    $('#btnActualizarEmpleado').click(function(){
      datos=$('#formEmpleadoU').serialize();

    $.ajax({
        type:"POST",
        data:datos,
        url:"procesos/actualizarEmpleados.php",
        success:function(r){
          if(r==1){
            $('#formEmpleadoU')[0].reset();
            alertify.success("Actualizado con exito.");
            $('#tabladatatable').load('A_tablas/A_tablaEmpleados.php');
            
          }
          else{
            alertify.error("No se pudo actualizar el empleado");
          }
        }
      }); 

    });


  });

  

</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#tabladatatable').load('A_tablas/A_tablaEmpleados.php');
  });


</script>


<script type="text/javascript">
  function agregarFormActualizar(cod_empleado){

    var parametros = {
                "cod_empleado" : cod_empleado,
        };

    $.ajax({

      type:"POST",
      data:parametros,
      url:"procesos/obtenerDatosEmpleados.php",
      success:function(r){

      datos=jQuery.parseJSON(r);   

      $('#cod_empleadoU').val(datos['cod_empleado']);
      $('#nombreU').val(datos['nom_empleado']);
      $('#salarioU').val(datos['salario_empleado']);
      $('#tipoU').val(datos['cod_tipo_empleado']);
      $('#correoU').val(datos['correo_empleado']);
      
      }

    });

  }

  function deshabilitarEmpleado(pCodEmpleado){

    alertify.confirm('Deshabilitar empleado', '¿Seguro desea deshabilitar este empleado?', 
          function(){ 
            var parametros = {
                "cod_empleado" : pCodEmpleado
            };

            $.ajax({

            type:"POST",
            data:parametros,
            url:"procesos/deshabilitarEmpleado.php",
            success:function(r){

              if(r==1){

                alertify.success("Se deshabilito");
                $('#tabladatatable').load('A_tablas/A_tablaEmpleados.php');

              }else{
                alertify.error("No se pudo deshabilitar");
              }

            }

            });
          }, 
          function(){ 
            
          });
  }

  function habilitarEmpleado(pCodEmpleado){

  alertify.confirm('Habilitar empleado', '¿Seguro desea habilitar este empleado?', 
        function(){ 
          var parametros = {
              "cod_empleado" : pCodEmpleado
          };

          $.ajax({

          type:"POST",
          data:parametros,
          url:"procesos/habilitarEmpleado.php",
          success:function(r){

            if(r==1){

              alertify.success("Se ha habilitado");
              $('#tabladatatable').load('A_tablas/A_tablaEmpleados.php');

            }else{
              alertify.error("No se ha podido habilitar");
            }

          }

          });
        }, 
        function(){ 
          
        });
  }
  
</script>
