<?php
require_once("../config/initialize.php");

use app\config\Connection;
use app\config\Functions;
use app\classes\Customers;

$functions = new Functions();

$pdo = new Connection();
$customer = new Customers($pdo);


if(isset($_POST['submit'])){
	if(!$customer->check_email_exist($_POST['email'])){

		if($customer->registration($from_order=0,$_POST)){
			?>
			<script type="text/javascript">
				alert('Registration successful');
			</script>
			<?php

			$functions->redirect('/clothmax/pages/signin.php');
		}
	}
	else{
		?>
		<script type="text/javascript">
			alert('User with this email already exists');
		</script>
		<?php
	}
}

require_once('../theme/header.php');

if(isset($_SESSION['loggedin'])){
    $functions->redirect('/clothmax/pages/profile.php');
}
?>

<!-- Signup Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact__text">
                    <div class="section-title">
                        <span>Sign Up</span>
                        <p>As you might expect of a company that began as a high-end interiors contractor, we pay
                            strict attention.</p>
                    </div>
                    <ul>
                        <li>
                            <h4>America</h4>
                            <p>195 E Parker Square Dr, Parker, CO 801 <br />+43 982-314-0958</p>
                        </li>
                        <li>
                            <h4>France</h4>
                            <p>109 Avenue Léon, 63 Clermont-Ferrand <br />+12 345-423-9893</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="contact__form">
                    <form role="form" method="POST" id="checkoutFormLogin">
	                    <input type="hidden" name="_token" value="">
	                    <div class="form-group">
	                        <label class="control-label">First Name</label>
	                        <div>
	                            <input type="text" class="form-control input-lg" name="firstName" value="" required>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="control-label">Last Name</label>
	                        <div>
	                            <input type="text" class="form-control input-lg" name="lastName" value="" required>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="control-label">E-Mail Address</label>
	                        <div>
	                            <input type="email" class="form-control input-lg" name="email" value="" required>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="control-label">Password</label>
	                        <div>
	                            <input type="password" class="form-control input-lg" name="password" required>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <div>
	                            <button type="submit" name="submit" class="btn btn-success">Sign Up</button><br>

	                            <span class="text-right"> Already have an account?<a class="btn btn-link" href="/clothmax/pages/signin.php">Login</a></span>
	                        </div>
	                    </div>
                	</form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Signup Section End -->

<?php
require_once('../theme/footer.php');
?>