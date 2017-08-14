<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Country City</title>  
    <link href="<?php echo base_url() ?>inc/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>inc/css/mystyle.css" rel="stylesheet">
</head>

<body>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-md-offset-4 col-md-4">
                <h1 class="text-center">Country City</h1>
                <div class="form-group">
                    <label for="country">Country :</label>
                    <select class="form-control" name="country" id="country">
                        <option value="">Select Country</option>
                        <?php foreach($countries as $country): ?>
                            <option value="<?php echo $country->country_id; ?>"><?php echo $country->country_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="pwd">City :</label>
                    <select class="form-control" name="city" id="city" disabled="">
                        <option value="">Select City</option>
                    </select>
                  </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function(){
           $('#country').on('change', function(){
                var country_id = $(this).val();
                if(country_id == '')
                {
                    $('#city').prop('disabled', true);
                }
                else
                {
                    $('#city').prop('disabled', false);
                    $.ajax({
                        url:"<?php echo base_url() ?>country_city/get_city",
                        type: "POST",
                        data: {'country_id' : country_id},
                        dataType: 'json',
                        success: function(data){
                           $('#city').html(data);
                        },
                        error: function(){
                            alert('Error occur...!!');
                        }
                    });
                }
           }); 
        });
    </script>

</body>

</html>
