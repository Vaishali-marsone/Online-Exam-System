<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Login </title>

    <!-- Favicon  -->
    <link rel="icon" href="../img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/theme.css" >
    <script src="js/jquery-2.2.4.min.js" ></script>
    <script src="js/bootstrap.min.js" ></script>
    <script src="js/popper.min.js" ></script>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

</head>

<body>
    <div class="container">

   
    <div class="col-md-6 mx-auto" style="margin-top:120px">
  <div class="card">
  <div class="card-header bg-primary text-white">
    Login
  </div>
  <div class="card-body">

     <form method="post" action="getLogin.php" class="">
    

        <div class="form-group">
            <input type="text" name="email" class="form-control"  placeholder="Email">
        </div>
        
     <div class="form-group">
     <input type="password" name="password" value=""  class="form-control" placeholder="Password">
     </div>

     <div class="submit"><input type="submit" value="Login" class="btn btn-primary"></div>

      <p><?php  if(isset($_REQUEST['msg'])) { echo "Invalid Login";}
      
      ?> </p>
   </form>
   </div>
  </div>
  </div>



</div>


  <footer id="footer">

    </footer>

    </body>
</html>