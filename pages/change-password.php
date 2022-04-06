<?php
require_once("../config/initialize.php");

use app\config\Connection;
use app\config\Functions;
use app\classes\Customers;


$pdo = new Connection();
$customer = new Customers($pdo);

$functions = new Functions();

require_once('../theme/header.php');

if (isset($_POST['submit'])) {
  if($customer->change_password($_POST)){
    echo "<script>alert('Password Updated')</script>";

    $functions->redirect('logout.php');
  }
}
?>

<!-- Change Password Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <?php require_once('../theme/side-nav.php'); ?>
              </div>
            <div class="col-lg-8 col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <form method="POST">
                    <input type="hidden" name="customer_id" value="<?= $_SESSION['cust_user_id']; ?>">
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">New Password</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="password" class="form-control" name="newPassword">
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Confirm Password</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="password" class="form-control" name="confirmPassword">
                </div>
              </div>
              <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9 text-secondary">
                  <input type="submit" class="btn btn-primary px-4" name="submit" value="Save Changes">
                </div>
              </div>
            </form>
              </div>
       		 </div>
    	</div>
    </div>
  </div>
</section>
<!-- Change Password Section End -->

<?php
require_once('../theme/footer.php');
?>