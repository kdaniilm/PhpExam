
<h3>Registration</h3>
<?php 
include_once("functions.php");
  if(!isset($_POST["regbtn"])){  ?>

<form action="index.php?page=3" method="POST">

<div class="form-group">
<label for="logn">Login: </label>
<input type="text" class="form-control" name="login">
</div>

<div class="form-group">
<label for="logn">Email: </label>
<input type="text" class="form-control" name="email">
</div>

<div class="form-group">
<label for="logn">Password: </label>
<input type="text" class="form-control" name="password">
</div>

<div class="form-group">
<label for="logn">Confirm Password: </label>
<input type="text" class="form-control" name="confirmPass">
</div>

<button type="submit" class="btn btn-primary" name="regbtn">Register</button>
</form>

<?php 
  }
  else{
    if(register($_POST["login"],$_POST["password"], $_POST["email"])){
        echo "<h3 style='color:green'>NEW USER ADDED</h3>";
    }
  }
  ?>