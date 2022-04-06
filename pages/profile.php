<?php
require_once("../config/initialize.php");

use app\config\Connection;
use app\classes\Customers;


$pdo = new Connection();
$customer = new Customers($pdo);

require_once('../theme/header.php');

$profileData = $customer->user_profile(($_SESSION['cust_user_id']) ?? '');
?>


<!-- Profile Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <?php require_once('../theme/side-nav.php'); ?>
            </div>
            <div class="col-lg-8 col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?= ucwords($profileData->customer_firstName.' '.$profileData->customer_lastName); ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?= $profileData->customer_email; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?= $profileData->customer_contact; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?= $profileData->customer_address; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info" href="/clothmax/pages/profile-edit.php?customerId=<?= $profileData->customer_id; ?>">Edit</a>
                    </div>
                  </div>
                </div>
              </div>
       		 </div>
    	</div>
    </div>
</section>
<!-- Profile Section End -->

<?php
require_once('../theme/footer.php');
?>