<?php
session_start();
	 if (isset($_SESSION["logedIn"])) {
        header('Location: syncronizer_csrf_token.php');
        exit();
    }else {
			
        if (isset($_POST['username']) && isset($_POST['password'])){
        
            if($_POST['username'] == "kalani" && $_POST['password']=="kalani1234"){
                $_SESSION["logedIn"] =$_POST['username'] .$_POST['password'];
                generateToken(); //generate token and store it in session variable(memory)
                header('Location: syncronizer_csrf_token.php');
            }else {
                echo '<div class="alert alert-danger">Invalid Credintials!</div>';
            }
        }
        
	 }
//generate token and store it in session variable(memory)
function generateToken(){
    return $_SESSION['syncronizer_csrf_token'] = base64_encode(openssl_random_pseudo_bytes(32));
}
?>

<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<style type="text/css">
body {
  margin: 0;
  padding: 0;
  background-color: #17a2b8;
  background-image: url("896801.jpg");
  height: 100vh;
}
#login .container #login-row #login-column #login-box {
  margin-top: 120px;
  max-width: 600px;
  height: 320px;
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
}
</style>
</head>
<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Synchronizer Token Pattern</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" method="post" action="login.php">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>