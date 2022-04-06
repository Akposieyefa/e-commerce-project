 <!-- Side Nav  Section Begin -->

<div class="list-group">
  <a href="/clothmax/pages/profile.php" class="list-group-item 
  <?php if ($pg == 'profile'): 
        echo 'active';
        elseif($pg == 'profile-edit'):
        echo 'active';
    endif;
     ?>">
    Profile
  </a>
  <a href="/clothmax/pages/order.php" class="list-group-item
  <?php if ($pg == 'order'): 
        echo 'active';
        elseif($pg == 'order-details'):
        echo 'active';
    endif;
     ?>">Orders</a>
  <a href="/clothmax/pages/change-password.php" class="list-group-item
  <?php if ($pg == 'change-password'): 
        echo 'active';
    endif;
     ?>">Change Password</a>
  <a href="/clothmax/pages/logout.php" class="list-group-item
  ">Logout</a>
</div>

<!-- Side Nav  Section Ends -->