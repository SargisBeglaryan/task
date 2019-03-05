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
                <form action="" method="post">
                  <div class="form-group row">
                    <label for="loginEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" name="loginEmail" class="form-control <?php if(isset($_POST['loginEmail']))  echo 'is-invalid'; ?>" id="loginEmail" placeholder="Email"
                       value="<?php if(isset($_POST['loginEmail'])){ echo $_POST['loginEmail'];}?>">
                       <?php if(isset($_POST['loginEmail'])) {
                        if(isset($errors['email'])) {
                          echo "<span class='invalid-feedback col-md-12' role='alert'>
                                  <strong> ".$errors['email']."</strong>
                                </span>";
                        }
                      }
                      ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="loginPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" name="loginPassword" class="form-control <?php if(isset($_POST['loginEmail'])) echo 'is-invalid'; ?>" id="loginPassword" placeholder="Password"
                       value="<?php if(isset($_POST['loginPassword'])){ echo $_POST['loginPassword'];}?>">
                       <?php if(isset($_POST['loginPassword'])) {
                        if(isset($errors['loginPassword'])) {
                          echo "<span class='invalid-feedback col-md-12' role='alert'>
                                  <strong>".$errors['loginPassword']."</strong>
                                </span>";
                        }
                      }
                      ?>
                    </div>
                  </div>
                  <div class="form-group row mt-5">
                    <div class="col-sm-12 text-center">
                      <button type="submit" name="login" class="btn btn-success">Login</button>
                    </div>
                    <div class="formError col-sm-offset-2 col-sm-10">
                      <?php if(isset($errors['user'])){ echo $errors['user'];}?>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
</div>

<?php require_once(ROOT.'/views/layouts/footer.php'); ?>
    
