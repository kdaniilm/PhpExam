<!-- <?php $page=1; ?>

<ul class="nav nav-tabs nav-justified">
  <li <?php echo($page==1)? "class='active'":"" ?>>
    <a href="index.php?page=1">&nbsp;&nbsp;tours&nbsp;&nbsp;</a>
  </li>
  <li <?php echo($page==2)? "class='active'":"" ?>>
    <a href="index.php?page=2">&nbsp;&nbsp;comments&nbsp;&nbsp;</a>
  </li>
  <li <?php echo($page==3)? "class='active'":"" ?>>
    <a href="index.php?page=3">&nbsp;&nbsp;registration&nbsp;&nbsp;</a>
  </li>
  <li <?php echo($page==4)? "class='active'":"" ?>>
    <a href="index.php?page=4">&nbsp;&nbsp; admin &nbsp;&nbsp;</a>
  </li>
</ul> -->

<nav class="navbar navbar-expand-lg navbar-light bg-light" style="border: solid 2px black">
  <div class="container">
    <!-- <a class="navbar-brand" href="#">MY SITE</a> -->

    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="index.php?page=1">Tours</a>
        <a class="nav-link" href="index.php?page=2">Comments</a>
        <a class="nav-link" href="index.php?page=3">Registration</a>
        <a class="nav-link" href="index.php?page=4">Admin</a>
      </div>
    </div>
  </div>
</nav>

