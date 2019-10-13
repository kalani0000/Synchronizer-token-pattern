<?php
   session_start();   
   if (isset($_POST['csrf_request']))
   	{
   	if ($_POST['csrf_request'] == $_SESSION["logedIn"]){
   		echo $_SESSION['syncronizer_csrf_token'];

   		} else	{
   		echo "null";
   		}
   	}  
?>