<html>
<head>
  <title>Login Form</title>
  <link href="<?php echo base_url().'inc/css/bootstrap.min.css' ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url().'inc/css/mystyle.css' ?>" rel="stylesheet" type="text/css">
</head>
<body>

<?php
   $attributes = array('class' => 'loginFormClass', 'id' => 'loginForm');
   echo form_open('login', $attributes);
?>

   <h1 class="registerTitle">Đăng nhập</h1>

   <!-- email field -->
   <div class="form-group">
      <input id="email" class="form-control" type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" placeholder="Số di động hoặc email" />
      <span id="emailError" class="mainError"></span>
      <?php if (form_error('email')) :?>
               <div class="errorCI"> 
                   <?php echo form_error('email'); ?>
               </div>
      <?php endif;?>
   </div>

   <!-- pass field -->
   <div class="form-group">
      <input id="password" class="form-control" type="text" name="password" value="<?php echo set_value('password'); ?>" size="50" placeholder="Mật khẩu mới" />
      <span id="passWordError" class="mainError"></span>
      <?php if (form_error('password')) :?>
               <div class="errorCI"> 
                   <?php echo form_error('password'); ?>
               </div>
      <?php endif;?>
   </div>

   <div>
      <input type="submit" value="Đăng nhập" class="btn buttonCreate" id="loginBtn" />
   </div>

</form>


  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="<?php echo base_url().'js/bootstrap.min.js' ?>"></script>
 
</body>
</html>