<?php $this->load->view('commons/header_upload'); ?>

<div class="container">
	<div class="page-header">
		<h1 class="text-center">Upload Image CodeIgniter</h1>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-6 col-md-offset-3">
			<?php if(isset($error)):?>
				<div class="alert alert-warning"><?php echo $error?></div>
			<?php endif; ?>
			<form action="<?php echo base_url('uploadCrop')?>" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label>Select image jpg or png</label>
					<input type="file" name="image" id="select-image"/>
				</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-6 col-md-offset-3">
			<p class="alert alert-info" id="text-information">Select image</p>
			<div id="imagem-box">
				<img src="" class="img-responsive hidden" id="upload_img" />
			</div>
			<input type="hidden" id="x" name="x" />
			<input type="hidden" id="y" name="y" />
			<input type="hidden" id="wcrop" name="wcrop" />
			<input type="hidden" id="hcrop" name="hcrop" />
			<input type="hidden" id="wvisual" name="wvisual" />
			<input type="hidden" id="hvisual" name="hvisual" />
			<input type="hidden" id="woriginal" name="woriginal" />
			<input type="hidden" id="horiginal" name="horiginal" />
			<div class="form-group text-center">
				<input type="submit" class="btn btn-success hidden" value="Upload" id="buttonUpload"/>
			</div>
			</form>
		</div>
	</div>
</div>

<?php $this->load->view('commons/footer_upload'); ?>
