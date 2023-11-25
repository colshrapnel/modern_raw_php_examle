<div class="col-md-6 col-md-offset-3">
  <h1 class="mb-5">Login</h1>
  <form role="form" method="post" action="">

    <div class="form-group<?php if ($error['email']): ?> has-error <?php endif ?>">
      <label class="control-label" for="inputError">Email</label>
      <input type="text" class="form-control" name="email" value="<?= htmlspecialchars($input['email']) ?>">
<?php if ($error['email']): ?>
      <span class="help-block"><?= htmlspecialchars($error['email']) ?></span>
<?php endif ?>
    </div>

    <div class="form-group<?php if ($error['password']): ?> has-error <?php endif ?>">
      <label class="control-label" for="password">Password</label>
      <input type="password" class="form-control" name="password">
<?php if ($error['password']): ?>
      <span class="help-block"><?= htmlspecialchars($error['password']) ?></span>
<?php endif ?>
    </div>

    <div class="d-flex justify-content-between">
      <button type="submit" class="btn btn-primary">Login</button>
      <a class="btn btn-outline-primary pull-right" href="login.php">Login</a>
    </div>
  </form>
</div>