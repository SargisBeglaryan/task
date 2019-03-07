<?php
$title = 'Register';
require_once(ROOT.'/views/layouts/header.php');
?>
<div class="container">
  <div class="row justify-content-center mt-5">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Reister</div>

        <div class="card-body">
          <div class="mt-2 mb-5 text-center">Already have an account? <a class="btn btn-link pt-0" href="/<?php echo WEBSITE; ?>/login">Sign in</a></div>
          <form action="" method="post">
            <?php $this->getToken(); ?>
            <div class="form-group row">
              <label for="name" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="text" name="name" class="form-control <?php if(isset($errors['name']))  echo 'is-invalid'; ?>" id="name" placeholder="Name"
                 value="<?php if(isset($_POST['name'])){ echo $_POST['name'];}?>">
                 <?php
                  if(isset($errors['name'])) {
                    echo "<span class='invalid-feedback' role='alert'>
                            <strong> ".$errors['name']."</strong>
                          </span>";
                  }
                ?>
              </div>
            </div>
            <div class="form-group row">
              <label for="name" class="col-sm-2 col-form-label">Surname</label>
              <div class="col-sm-10">
                <input type="text" name="surname" class="form-control <?php if(isset($errors['surname']))  echo 'is-invalid'; ?>" id="surname" placeholder="Surname"
                 value="<?php if(isset($_POST['surname'])){ echo $_POST['surname'];}?>">
                 <?php
                  if(isset($errors['surname'])) {
                    echo "<span class='invalid-feedback' role='alert'>
                            <strong> ".$errors['surname']."</strong>
                          </span>";
                  }
                ?>
              </div>
            </div>
            <div class="form-group row">
              <label for="signInEmail" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="text" name="signInEmail" class="form-control <?php if(isset($errors['email']))  echo 'is-invalid'; ?>" id="signInEmail" placeholder="Email"
                 value="<?php if(isset($_POST['signInEmail'])){ echo $_POST['signInEmail'];}?>">
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
              <label for="signInPassword" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <input type="password" name="signInPassword" class="form-control <?php if(isset($errors['password']))  echo 'is-invalid'; ?>" id="signInPassword" placeholder="Password"
                 >
                 <?php
                  if(isset($errors['password'])) {
                    echo "<span class='invalid-feedback' role='alert'>
                            <strong> ".$errors['password']."</strong>
                          </span>";
                  }
                ?>
              </div>
            </div>
            <div class="form-group row mt-5">
              <div class="col-sm-12 text-center">
                <button type="submit" name="login" class="btn btn-success">Register</button>
              </div>
                <?php if(isset($errors['user'])){ 
                  echo '<div class="alert alert-danger" role="alert"><strong>'.$errors['user'].'</strong></div>';
                }
                ?>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>

<?php require_once(ROOT.'/views/layouts/footer.php'); ?>