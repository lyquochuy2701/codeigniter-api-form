<!DOCTYPE html>
<html>
<head>
	<title>Excel import</title>
	<link href="<?php echo base_url().'inc/css/excel.css' ?>" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="formExcel">									
		<?php echo form_open_multipart('excel_import/ExcelDataAdd');?>                      
			<h2>Upload file excel</h2>        
			<p id="userfile"><input type="file" name="userfile" /></p>			                   
			<p><input type="submit" value="upload" name="upload" /></p>

		</form>	
			<?php 
				$message = $this->session->flashdata('message');
				if(isset($message)) : ?>
			  	<p class="success"><?php echo "Upload successfully";?></p>
			<?php endif;?>
	</div>
</body>
</html>