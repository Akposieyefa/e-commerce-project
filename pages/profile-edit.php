<?php
require_once("../config/initialize.php");

use app\config\Connection;
use app\classes\Customers;


$pdo = new Connection();
$customer = new Customers($pdo);

require_once('../theme/header.php');

$profileData = $customer->user_profile($_SESSION['cust_user_id']);

if (isset($_POST['edit'])) {
  if($customer->user_edit_profile($_POST)){
    echo "<script>alert('Profile Updated')</script>";
  }
}
?>


<!-- Profile Edit Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <?php require_once('../theme/side-nav.php'); ?>
              </div>
            <?php if($profileData): ?>
            <div class="col-lg-8 col-md-8">
              <div class="card mb-3">
                <div class="card-body">
            <form method="POST">
              <input type="hidden" name="customer_id" value="<?= $profileData->customer_id; ?>">
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Full Name:</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="text" class="form-control" name="name" value="<?= ucwords($profileData->customer_firstName.' '.$profileData->customer_lastName); ?>">
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Email:</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="text" class="form-control" name="email" value="<?= $profileData->customer_email; ?>">
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Phone:</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="text" class="form-control" name="phone" value="<?= $profileData->customer_contact; ?>">
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Gender:</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <select class="form-control" name="gender">
                    <option value="<?= $profileData->customer_gender; ?>"><?= $profileData->customer_gender; ?></option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Address:</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="text" class="form-control" name="address" value="<?= $profileData->customer_address; ?>">
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">City:</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="text" class="form-control" name="city" value="<?= $profileData->customer_city; ?>">
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">State:</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="text" class="form-control" name="state" value="<?= $profileData->customer_state; ?>">
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Country:</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="text" class="form-control" name="country" value="<?= $profileData->customer_country; ?>">
                </div>
              </div>
              <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9 text-secondary">
                  <input type="submit" class="btn btn-primary px-4" name="edit" value="Save Changes">
                </div>
              </div>
            </form>
              </div>
       		  </div>
            <?php endif; ?>
    	</div>
    </div>
  </div>
</section>
<!-- Profile Edit Section End -->

<?php
require_once('../theme/footer.php');
?>