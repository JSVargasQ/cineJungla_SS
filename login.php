
<!DOCTYPE html>
<html>
<head>
  <title>Cine Jungla</title>
  <?php require_once "scripts.php";
  ?>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

</head>
<style>
  .container{
    width:250px;
    border:solid 2px #000;
  }
</style>
<body background ="imagenes/fondojungla.jpg"></body>
<div class="container" >
    <img class="img-fluid" src="imagenes/cinejungla.jpeg" alt=""> 
  </div>
  <div class="d-flex justify-content-center h-80">
    <div class="card" style="width: 18rem;">
      <div  align="center" class="card-header">
        <h3>Inicio de sesion</h3>
      </div>
      <div class="card-body">
        <form action="" method="POST">
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <label></label>
          <input type="text" id="usuario" class="form-control input-sm" name="username" placeholder="usuario">
          </div>
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
          <input type="password" id="password" class="form-control input-sm" name="password" placeholder="contraseña">
          </div>
          <div class="col d-flex justify-content-center">
            <style type="text/css"> .div{
                text-align: center;
            }

            </style>
           <?php
           if(isset($errorEntrada)){
           echo $errorEntrada;
         }


           ?>
          </div>
          <div class="form-group" align="center">
                       <input   style="color:#000000; background-color:  #008f39" type="submit" name="submit" class="form-control btn btn-succes" value="Log in">

          </div>

        </form>
      </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>