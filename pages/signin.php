<?php
require_once("../config/initialize.php");

use app\config\Connection;
use app\config\Functions;
use app\classes\Customers;

$functions = new Functions();

$pdo = new Connection();
$customer = new Customers($pdo);


require_once('../theme/header.php');
if(isset($_SESSION['loggedin'])){
    $functions->redirect('/clothmax/pages/profile.php');
}

if(isset($_POST['submit'])){
	if($customer->check_email_exist($_POST['loginEmail'])){

		if($customer->login($_POST)){
			?>
			<script type="text/javascript">
				alert('Loggedin successful');
			</script>
			<?php

			$functions->redirect('/clothmax/pages/profile.php');
		}
	}
	else{
		?>
		<script type="text/javascript">
			alert('User does not exists');
		</script>
		<?php
	}
}
?>

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact__text">
                    <div class="section-title">
                        <span>Sign In</span>
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
	                    <input type="hidden" name="token" value="loginmain">
	                    <div class="form-group">
	                        <label class="control-label">E-Mail Address</label>
	                        <div>
	                            <input type="email" class="form-control input-lg" name="loginEmail" value="" required>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="control-label">Password</label>
	                        <div>
	                            <input type="password" class="form-control input-lg" name="loginPassword" required>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <div>
	                            <button type="submit" name="submit" class="btn btn-success">Sign in</button><br>

	                            <span class="text-right"> Don't have an account?<a class="btn btn-link" href="/clothmax/pages/signup.php">Sign up</a></span>
	                        </div>
	                    </div>
                	</form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

<?php
require_once('../theme/footer.php');
?>