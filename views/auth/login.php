<?php 
$title = 'Login';
require_once(ROOT.'/views/layouts/header.php');
?>
<div class="container">
  <div class="row justify-content-center mt-5">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Login</div>

        <div class="card-body">
          <div class="mt-2 mb-5 text-center">Don't have an account? <a class="btn btn-link pt-0" href="/<?php echo WEBSITE; ?>/register">Sign up</a></div>
          <form action="/<?php echo WEBSITE; ?>/login" method="post">
            <?php $this->getToken(); ?>
            <div class="form-group row">
              <label for="loginEmail" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="email" name="loginEmail" class="form-control <?php if(isset($errors['email']))  echo 'is-invalid'; ?>" id="loginEmail" placeholder="Email"
                 value="<?php if(isset($_POST['loginEmail'])){ echo $_POST['loginEmail'];}?>">
                 <?php
                  if(isset($errors['email'])) {
                    echo "<span class='invalid-feedback' role='alert'>
                            <strong> ".$errors['email']."</strong>
                          </span>";
                  }
                ?>
              </div>
            </div>
            <div class="form-group row">
              <label for="loginPassword" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <input type="password" name="loginPassword" class="form-control <?php if(isset($errors['password'])) echo 'is-invalid'; ?>" id="loginPassword" placeholder="Password">
                 <?php
                  if(isset($errors['password'])) {
                    echo "<span class='invalid-feedback' role='alert'>
                            <strong>".$errors['password']."</strong>
                          </span>";
                  }
                ?>
              </div>
            </div>
            <div class="form-group row mt-5">
              <div class="col-sm-12 text-center">
                <button type="submit" name="login" class="btn btn-success">Login</button>
              </div>
              <div class="col-sm-12 mt-4">
                <?php if(isset($errors['user'])){ 
                  echo '<div class="alert alert-danger" role="alert"><strong>'.$errors['user'].'</strong></div>';
                }
                ?>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>

<?php require_once(ROOT.'/views/layouts/footer.php'); ?>
    
