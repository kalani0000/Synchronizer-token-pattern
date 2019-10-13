<?php
//start the session
session_start();
//check for login status
if (!$_SESSION["logedIn"]) {
    header('Location: login.php');
    exit();
  } else {
    echo '
        <div class="container">
            <div class="alert alert-success">
                <strong> Welcome Kalani! </strong> <a href="signout.php">Sign out</a> 
            </div>
        </div>';
}


//validate whether retrieved token is same as the server token
function validateToken($token){
    return $token ===$_SESSION['syncronizer_csrf_token'];
}

//check form validations
if (isset($_POST['syncronizer_csrf_token']) && isset($_POST['account_number']) && isset($_POST['name']) && isset($_POST['amount'])) {
    //check for token validation
    if (validateToken($_POST['syncronizer_csrf_token'])) {
      echo '<div class="container"> 
                <div class="alert alert-success">
                    Transaction successful!!
                </div>
		    </div>';
    } else {
      echo '<div class="container">  
                <div class="alert alert-danger alert-dismissible fade in">
				    Invalid CSRF Token
			    </div>
		    </div>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<style type="text/css">
        body {
        margin: 0;
        padding: 0;
        background-color: #17a2b8;
        background-image:url("ch4.jpg");
        height: 100vh;
        }
</style>
</head>
<body>
    <div class="container">
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Fund Transfer</div>
            </div>
            <div style="padding-top:30px" class="panel-body" >
                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                <form id="changeForm" class="form-horizontal" role="form" method="post" action="syncronizer_csrf_token.php">
                    <div style="margin-bottom: 25px" class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Account Number</label> 
                            <div class="col-md-4">
                                <input type="number" class="form-control" name="account_number"  placeholder="15XXXXXXXXXX" required>
                            </div>
                        </div>
                    <div style="margin-bottom: 25px" class="form-group">
                        <label class="col-md-4 control-label" for="textinput">Name</label> 
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="name" placeholder="" required>
                        </div>
                    </div>
                    <div style="margin-bottom: 25px" class="form-group">
                        <label class="col-md-4 control-label" for="textinput">Amount</label> 
                        <div class="col-md-4">
                            <input type="number" class="form-control" name="amount" placeholder="00.00" required>
                            <!-- pass token with the hidden field value -->
                            <input  type="hidden" class="form-control" id="syncronizer_csrf_token" name="syncronizer_csrf_token" value="token">
                        </div>
                    </div>
                        <div style="margin-top:10px" class="form-group">
                        <div class="col-md-4">
                        </div>
                        <div class="col-sm-4 controls">
                            <button id="btn-bd" class="btn btn-lg btn btn-success btn-block btn-signin" value="update" type="submit">Transfer Credit</button>
                        </div>
                    </div>
                    <span id="message"></span>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script>
      $(document).ready(function () {
          $.ajax({
              url: 'csrf_token.php',
              type: 'post',
              async: false,
              data: {
                  //pass login session to validate request with the server
                  'csrf_request': '<?php echo $_SESSION["logedIn"] ?>'  
              },
              success: function (data) {
                    //set returned token to hidden field value
                  document.getElementById("syncronizer_csrf_token").value = data;
                  $("#syncronizer_csrf_token").text(data);
              },
              error: function (xhr, ajaxOptions, thrownError) {
                  console.log("Error on Ajax call :: " + xhr.responseText);
              }
          });
      });
   </script>
</html>
