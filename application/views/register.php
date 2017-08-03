<html>
<head>
<title>Register Form</title>
<link href="<?php echo base_url().'inc/css/bootstrap.min.css' ?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url().'inc/css/mystyle.css' ?>" rel="stylesheet" type="text/css">
</head>
<body>


<?php
   $attributes = array('class' => 'registerFormClass', 'id' => 'registerForm');
   echo form_open('register', $attributes);
?>

   <h1 class="registerTitle">Đăng ký</h1>
   <h3 class="subRegisterTitle">Luôn miễn phí</h3>

   <!-- firstname and lastname filed -->
   <div class="form-group row">
  
      <div class="col-md-6">
         <input id="firstName" class="form-control fullName" type="text" name="firstName" value="<?php echo set_value('firstName'); ?>" size="50" placeholder="Họ" />
         <span id="firstNameError" class="mainError"></span>
         <?php if (form_error('firstName')) :?>
               <div class="errorCI"> 
                   <?php echo form_error('firstName'); ?>
               </div>
         <?php endif;?>
      </div>
      <div class="col-md-6">
         <input id="lastName" type="text" class="form-control fullName" name="lastName" size="50"  placeholder="Tên" value="<?php echo set_value('lastName'); ?>">
         <span id="lastNameError" class="mainError"></span>
         <?php if (form_error('lastName')) :?>
               <div class="errorCI"> 
                   <?php echo form_error('lastName'); ?>
               </div>
         <?php endif;?>
      </div>
   </div> 


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



   <div class="clear" style="clear:both">
   </div>

   <!-- date field -->
   <div class="form-group ngaysinhWrapper">
      <p id="birthday">Ngày sinh:</p>
      <div class="col-md-8 dateWrapper">
         <select class="datethreeField" name="daySelect">
              <option value="">Day</option>
                  <?php
                     for ($dayFor = 1; $dayFor <= 31; $dayFor++) {  
                        $daySelect = set_select("daySelect",$dayFor); 
                        ?>
                        <option value="<?php if($dayFor<10) {echo "0".$dayFor;}
                                          else{
                                            echo $dayFor;
                                          }
                                        ?>" 
                        <?php if(isset($daySelect)) echo $daySelect; ?>><?php echo $dayFor;?></option> 
                     <?php } 
                  ?>
         </select>
         <select class="datethreeField" name="monthSelect">
              <option value="">Month</option>
                  <?php
                     for ($monthFor = 1; $monthFor <= 12; $monthFor++) { 
                        $monthSelect = set_select("monthSelect",$monthFor); 
                        ?>
                        <option value="<?php if($monthFor<10) {echo "0".$monthFor;}
                                        else{
                                          echo $monthFor;
                                        }

                        ?>" 

                        <?php if(isset($monthSelect)) echo $monthSelect; ?>><?php echo $monthFor;?></option> 
                     <?php } 
                  ?>
         </select>
         <select class="datethreeField" name="yearSelect">
              <option value="">Year</option>
                  <?php
                     for ($yearFor = 1900; $yearFor <= 2017; $yearFor++) {                     
                        $yearSelect = set_select("yearSelect",$yearFor); 
                        ?>
                        <option value="<?php echo $yearFor;?>" <?php if(isset($yearSelect)) echo $yearSelect; ?>><?php echo $yearFor;?></option> 
                     <?php } 
                  ?>
         </select>
         <span id="dayError" class="mainError"></span>
         <?php if (form_error('daySelect') || form_error('monthSelect') || form_error('yearSelect')) :?>
               <div class="errorCI"> 
                   <p>The Date field is required.</p>
               </div>
         <?php endif;?>
      </div>     
      <div class="col-md-4 rightDate">
         <p><a href="#">Tại sao tôi cân cung cấp ngày sinh của mình</a></p>
      </div> 
   </div>

   <div class="clear" style="clear:both">
   </div>

   <!-- gender field -->
   <div class="form-group genderWrapper">
      <div class="row">
         <div class="col-xs-2">
             <label class="radio-inline">
                 <input class="gender" type="radio" name="gender" value="female" <?php echo  set_radio('gender', 'female'); ?>> Nữ
             </label>
         </div>
         <div class="col-xs-2">
             <label class="radio-inline">
                 <input class="gender" type="radio" name="gender" value="male" <?php echo  set_radio('gender', 'male'); ?>> Nam 
             </label>
         </div>
      </div>
      <span id="genderError" class="mainError"></span>
      <?php if (form_error('gender')) :?>
               <div class="errorCI"> 
                   <p>The Gender field is required.</p>
               </div>
      <?php endif;?>
   </div>
   

   <p class="rulesForm">Bằng cách nhấp vào Tạo tài khoản, bạn đồng ý với <a href="#">Điều khoản</a> của chúng tôi và rằng bạn đã đọc <a href="#">Chính sách dữ liệu</a> của chúng tôi, bao gồm <a href="#">Sử dụng cookie</a>. Bạn có thể nhận được thông báo qua SMS từ Facebook và có thể bỏ chọn bất kỳ lúc nào.</p>

   <div>
      <input type="submit" value="Tạo Tài khoản" class="btn buttonCreate" id="validateBtn" />
   </div>

</form>




   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   <!-- Include all compiled plugins (below), or include individual files as needed -->
   <script src="<?php echo base_url().'inc/js/bootstrap.min.js' ?>"></script>
   
  
   <script language="javascript">
      $(document).ready(function(){
                
        // check mail function
        function isEmail(emailStr) {
          var emailPat=/^(.+)@(.+)$/
          var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]"
          var validChars="\[^\\s" + specialChars + "\]"
          var quotedUser="(\"[^\"]*\")"
          var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/
          var atom=validChars + '+'
          var word="(" + atom + "|" + quotedUser + ")"
          var userPat=new RegExp("^" + word + "(\\." + word + ")*$")
          var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$")
          var matchArray=emailStr.match(emailPat)
          if (matchArray==null) {
              return false
          }
          var user=matchArray[1]
          var domain=matchArray[2]
        
          // See if "user" is valid
          if (user.match(userPat)==null) {
            return false
          }
          var IPArray=domain.match(ipDomainPat)
            if (IPArray!=null) {
            // this is an IP address
            for (var i=1;i<=4;i++) {
                if (IPArray[i]>255) {
                    return false
                }
            }
            return true
          }
          var domainArray=domain.match(domainPat)
            if (domainArray==null) {
            return false
          }
        
          var atomPat=new RegExp(atom,"g")
          var domArr=domain.match(atomPat)
          var len=domArr.length
        
          if (domArr[domArr.length-1].length<2 ||
            domArr[domArr.length-1].length>3) {
            return false
          }
        
          if (len<2)
          {
            return false
          }
        
             return true;
        }// end function email

          //  form submit
          $('#registerForm').submit(function(){
            var firstName    = $.trim($('#firstName').val());
            var lastName    = $.trim($('#lastName').val());
            var password = $.trim($('#password').val());
            var email       = $.trim($('#email').val());
            var gender   =  $('input[name=gender]:checked').val();
            var day_Select = $("select[name=daySelect] option:selected").val();
            var month_Select = $("select[name=monthSelect] option:selected").val();
            var year_Select = $("select[name=yearSelect] option:selected").val();
          
            var flag = true;
            // firtName
            if (firstName == ''){
              $("#firstNameError").text("Please provide your first name");
              flag = false;
            }
            else{
              $('#firstNameError').text('');
            }
        
            // lastName
            if (lastName == ''){
              $('#lastNameError').text('Please provide your last name');
              flag = false;
            }
            else{
              $('#lastNameError').text('');
            }

            // password
            if (password == ''){
              $('#passWordError').text('Please provide your password');
              flag = false;
            }
            else{
              $('#passWordError').text('');
            }
       
       
            // Email
            if (!isEmail(email) && isNaN(email) || email == ''){
              $('#emailError').text('Please provide a correct email or your phone');
              flag = false;
            }
            else{
                $('#phoneormail_error').text('');
                $('#emailError').removeClass("showError").addClass("hiddenError");
            }


            // gender
            if (gender == undefined || gender == '' ){
              $('#genderError').text('Please provide your gender');
              flag = false;
            }
            else{
              $('#genderError').text('');
            }

            // day month year
            if(day_Select == '' && month_Select == '' && year_Select == ''){
              $('#dayError').text('Please provide your date');
              flag = false;
            } 
            else{
              $('#dayError').text('');
            }
    
            return flag;                   
          });// end form submit

          // effect validate

          $('#firstName').keyup(function(event) {
            var input_index = $(this);
            var value_input = $(this).val();
             
            if(value_input.length > 0 ){
              $("#firstNameError").removeClass("showError").addClass("hiddenError");
            }
          }); 
          $('#lastName').keyup(function(event) {
            var input_index = $(this);
            var value_input = $(this).val();
            if(value_input.length > 0 ){
              $("#lastNameError").removeClass("showError").addClass("hiddenError");
            }
          }); 
         
          $('#password').keyup(function(event) {
            var input_index = $(this);
            var value_input = $(this).val();
             
            if(value_input.length > 0 ){
              $("#passWordError").removeClass("showError").addClass("hiddenError");
            }
          });
          $('#email').keyup(function(event) {
            var input_index = $(this);
            var value_input = $(this).val();
             
            if(isEmail(value_input) || !isNaN(value_input) && value_input.length > 0){
              $("#emailError").removeClass("showError").addClass("hiddenError");
            }

          });
          $('#registerForm input[type=radio]').change(function() {
            var input_index = $(this);
            var value_input = $(this).val();
             
            if(value_input.length > 0 ){
              $("#genderError").removeClass("showError").addClass("hiddenError");
            }
          });

          $('#registerForm select').change(function() {
            var day_Select = $("select[name=daySelect] option:selected").val();
            var month_Select = $("select[name=monthSelect] option:selected").val();
            var year_Select = $("select[name=yearSelect] option:selected").val();
            if(day_Select != '' && month_Select != '' && year_Select != ''){
                
              $("#dayError").removeClass("showError").addClass("hiddenError");
            }
         });
      });
    </script>
</body>
</html>