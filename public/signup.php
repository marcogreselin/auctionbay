<?php
//  Dependencies
require_once("../includes/session.php");
require_once("../includes/validation_functions.php");
require_once("../includes/output.php");


//SESSION is used to communicate errors between signup.php and address.php
if(isset($_SESSION['errors']))
  $errors = $_SESSION['errors'];

$firstname  = repeat_input("firstname");
$lastname   = repeat_input("lastname");
$email      = repeat_input("email");

require_once("../includes/layouts/header_default.php");
?>

    <div class="row">
        <div class="col-sm-4 header-signup">
            <h1>Sign Up</h1>
        </div>
        <div class="col-sm-8 pull-left login-box">
            <p>
              <?php
                //  if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
                //    print_r($_SESSION['errors']);
                //  }

                if(isset($errors) && !empty($errors)) {
                  echo
                      "<div class=\"alert alert-danger\">
                          <button class=\"close fui-cross\" data-dismiss=\"alert\"></button>
                          <h4>Oops!</h4>";
                          output_errors();
                  echo "</div>";

                  clear_errors();
                }

                ?>
            </p>
        </div>
    </div>


    <form class="sign-up-form form-horizontal" action="address.php" method="post">

        <div class="form-group form-group-hg">
            <label class="control-label col-sm-4" for="firstname"><h4>First Name:</h4></label>
            <div class="col-sm-8">
                <input type="text" class="form-control"
                name="firstname"
                <?php echo "value='{$firstname}'"; ?>
                id="firstname" placeholder="Your first name">
            </div>
        </div>

        <div class="form-group form-group-hg">
            <label class="control-label col-sm-4" for="lastname"><h4>Last Name:</h4></label>
            <div class="col-sm-8">
                <input type="text" class="form-control"
                name="lastname"
                <?php echo "value='{$lastname}'"; ?>
                id="lastname" placeholder="Your last name">
            </div>
        </div>

        <div class="form-group form-group-hg">
            <label class="control-label col-sm-4" for="email"><h4>Email:</h4></label>
            <div class="col-sm-8">
                <input type="email" class="form-control"
                name="email"
                <?php echo "value='{$email}'"; ?>
                id="email" placeholder="Enter email">
            </div>
        </div>

        <div class="form-group form-group-hg">
            <label class="control-label col-sm-4" for="pwd"><h4>Password:</h4></label>
            <div class="col-sm-8">
                <input type="password" class="form-control"
                name="password"
                value=""
                id="pwd" placeholder="Enter password">
            </div>
        </div>

        <div class="form-group form-group-hg">
            <label class="control-label col-sm-4" for="pwdagain"><h4>Password again:</h4></label>
            <div class="col-sm-8">
                <input type="password" class="form-control"
                name="passwordagain"
                value=""
                id="pwdagain" placeholder="Enter password again">
            </div>
        </div>

        <div class="container text-center">
            <div class="form-group container-survey-radio">
                <div class="row">
                    <div class="col-xs-2 col-xs-offset-4">
                        <label class="radio-inline control-label">
                            <div class="form-group container-survey-yesno">
                                <input class="role-checkbox"
                                       type="radio"
                                       id="role-checkbox-buyer"
                                       name="role-check"
                                       value="1"/>
                                <label class="role-check-label" for="role-checkbox-buyer">
                                    Buyer
                                </label>
                            </div>
                        </label>
                    </div>


                    <div class="col-xs-6">
                        <label class="radio-inline control-label">
                            <div class="form-group container-survey-yesno">
                                <input class="role-checkbox"
                                       type="radio"
                                       id="role-checkbox-seller"
                                       name="role-check"
                                       value="2"/>
                                <label class="role-check-label" for="role-checkbox-seller">
                                    Seller
                                </label>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>


        <div class="form-group form-group-hg">
            <div class="col-sm-8 col-sm-offset-4 text-center">
                <input class="btn btn-hg btn-primary btn-block"
                type="submit" name="submit" value="Continue to enter you address">
            </div>
        </div>
    </form>
</div>


<?php
require_once('../includes/layouts/footer.php');
//clear session when done rendering page
clear_session(); ?>
