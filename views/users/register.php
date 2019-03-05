<?php require_once(ROOT.'/views/layouts/header.php'); ?>
<div class="signIn well">
  <form class="form-horizontal" action="" method="post" autocomplete="off" enctype="multipart/form-data" novalidate>
  <?php if(isset($_POST['name'])) {
            if(isset($errors['name'])) {
              $nameClass = 'has-error';
            } else {
              $nameClass = 'has-success';
            } 
          }else {
            $nameClass = '';
          }
    ?>
    <div class="form-group <?php echo $nameClass; ?> has-feedback">
      <label for="name" class="col-sm-2 control-label">Name</label>
      <div class="col-sm-10">
        <input type="text" name="name" class="form-control" id="name" placeholder="Name"
        value="<?php if(isset($_POST['name'])){ echo $_POST['name'];}?>">
        <?php if(isset($_POST['name'])) {
          if(isset($errors['name'])) {
            echo '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
              <span class="errorMessage">'.$errors['name'].'</span>';
          } else {
            echo '<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>';
          }
        }
        ?>
      </div>
    </div>
    <?php if(isset($_POST['surname'])) {
            if(isset($errors['surname'])) {
              $surnameClass = 'has-error';
            } else {
              $surnameClass = 'has-success';
            } 
          }else {
            $surnameClass = '';
          }
    ?>
    <div class="form-group <?php echo $surnameClass; ?> has-feedback"">
      <label for="name" class="col-sm-2 control-label">Surname</label>
      <div class="col-sm-10">
        <input type="text" name="surname" class="form-control" id="name" placeholder="Surname"
        value="<?php if(isset($_POST['surname'])){ echo $_POST['surname'];}?>">
        <?php if(isset($_POST['surname'])) {
          if(isset($errors['surname'])) {
            echo '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
              <span class="errorMessage">'.$errors['surname'].'</span>';
          } else {
            echo '<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>';
          }
        }
        ?>
      </div>
    </div>
    <?php if(isset($_POST['signInEmail'])) {
            if(isset($errors['email'])) {
              $emailClass = 'has-error';
            } else {
              $emailClass = 'has-success';
            } 
          }else {
            $emailClass = '';
          }
    ?>
    <div class="form-group <?php echo $emailClass; ?> has-feedback"">
      <label for="signInEmail" class="col-sm-2 control-label">Email</label>
      <div class="col-sm-10">
        <input type="email"  name="signInEmail"class="form-control" id="signInEmail" placeholder="Email"
        value="<?php if(isset($_POST['signInEmail'])){ echo $_POST['signInEmail'];}?>">
        <?php if(isset($_POST['signInEmail'])) {
          if(isset($errors['email'])) {
            echo '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
              <span class="errorMessage">'.$errors['email'].'</span>';
          } else {
            echo '<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>';
          }
        }
        ?>
      </div>
    </div>
    <?php if(isset($_POST['signInPassword'])) {
            if(isset($errors['password'])) {
              $passClass = 'has-error';
            } else {
              $passClass = 'has-success';
            } 
          }else {
            $passClass = '';
          }
    ?>
    <div class="form-group <?php echo $passClass; ?> has-feedback"">
      <label for="signInPassword" class="col-sm-2 control-label">Password</label>
      <div class="col-sm-10">
        <input type="password" name="signInPassword" class="form-control" id="signInPassword" placeholder="Password" value="<?php if(isset($_POST['signInPassword'])){ echo $_POST['signInPassword'];}?>">
        <?php if(isset($_POST['signInPassword'])) {
          if(isset($errors['password'])) {
            echo '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
              <span class="errorMessage">'.$errors['password'].'</span>';
          } else {
            echo '<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>';
          }
        }
        ?>
      </div>
    </div>
    <?php if(isset($_FILES['image'])) {
            if(isset($errors['image'])) {
              $imageClass = 'has-error';
            } else {
              $imageClass = 'has-success';
            } 
          }else {
            $imageClass = '';
          }
    ?>
    <div class="form-group <?php echo $imageClass; ?> has-feedback"">
     <div id="imageContent" class="col-sm-10">
      <label for="image" id="imageLabel" class="imageLabel control-label">
        <?php if (isset($_FILES['image']) && $_FILES['image']['error'] != 4) {
                  echo $_FILES['image']['name'];
              }  else {
                  echo 'Upload image';
              }
        ?>
      </label>
      <?php if(isset($_FILES['image'])) {
          if(isset($errors['image'])) {
            echo '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
              <span class="errorMessage">'.$errors['image'].'</span>';
          } else {
            echo '<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>';
          }
        }
        ?>
        <input type="file" name="image" class="form-control" id="image" placeholder="Image">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10 submit-div">
        <button type="submit" name="signIn" class="btn btn-success">Sign In</button>
        <div class="formError col-sm-offset-2 col-sm-10">
        <?php if(isset($errors['userAdded'])){ echo $errors['userAdded'];}?>
      </div>
      </div>
    </div>
  </form>
</div>

<?php require_once(ROOT.'/views/layouts/footer.php'); ?>