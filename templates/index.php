<div class="col-md-4 col-md-offset-4">
  <h1 class="mb-5">Sample application</h1>
<?php if(isset($_SESSION['user_id'])): ?>
    <div class="d-flex justify-content-between">
      Welcome on board!
    </div>
<?php else: ?>
    <div class="d-flex justify-content-between">
      <a class="btn btn-outline-primary" href="registration.php">Register</a>
    </div>
    <div class="d-flex justify-content-between">
      <a class="btn btn-outline-primary" href="login.php">Login</a>
    </div>
<?php endif ?>
</div>