<?php
if (
    $_SERVER['REQUEST_METHOD'] == 'GET' &&
    realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])
) {
    // header('Location: ../index.php');
    header('Location: ' . ROOT_URL . 'index.php');
}
if (isset($_POST['signup'])) {
    $screenName = $_POST['screenName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $error = '';

    if (empty($screenName) or empty($password) or empty($email)) {
        $error = 'All fields are required';
    } else {
        $email = $getFromU->checkInput($email);
        $screenName = $getFromU->checkInput($screenName);
        $password = $getFromU->checkInput($password);

        if (!filter_var($email)) {
            $error = 'Invalid email format';
        } elseif (strlen($screenName) > 20) {
            $error = 'Name must be between in 6-20 characters';
        } elseif (strlen($password) < 5) {
            $error = 'Password is too short';
        } else {
            if ($getFromU->checkEmail($email) === true) {
                $error = 'Email is already in use';
            } else {
                $user_id = $getFromU->create('users', [
                    'email' => $email,
                    'password' => md5($password),
                    'screenName' => $screenName,
                    'profileImage' => '<?= ROOT_URL ?>images/defaultProfileImage.png',
                    'profileCover' => '<?= ROOT_URL ?>images/defaultCoverImage.png',
                ]);
                $_SESSION['user_id'] = $user_id;
                header('Location: ' . ROOT_URL . 'includes/signup.php?step=1');
            }
        }
    }
}
?>


<form method="post" autocomplete="off">
              <?php if (isset($error)) {
                  echo '<div class="alert alert-danger" role="alert"style="width: 300px; margin:20px auto;text-align:center;">
              ' .
                      $error .
                      '
            </div>';
              } ?>    
    <div class="signup-form">
            <div class="form-group">
              <input class="form-control" type="text" name="screenName" placeholder="Full Name" />
            </div>
            <div class="form-group">
              <input class="form-control" type="email" name="email" placeholder="Email" />
            </div>
            <div class="form-group">
              <input class="form-control" type="password" name="password" placeholder="Password" />
            </div>
            <input class="new-btn m-auto mt-5" type="submit" name="signup" value="Signup">
          </div>

</form>
<script type="text/javascript">
        setTimeout(function() {
            // Closing the alert 
            $('#alert').alert('close');
        }, 3500);

    </script>