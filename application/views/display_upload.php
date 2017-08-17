<?php $this->load->view('commons/header_upload'); ?>

<div class="container">
	<div class="page-header">
		<h1 class="text-center">Upload Images CodeIgniter</h1>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-center">
			<h3>Image drop</h3>
			<hr />
				<div id="imagem-box">
					<img src="<?php echo $this->session->flashdata('urlImage');?>" class="img-responsive"/>
				</div>
				<p><a href="<?php echo base_url();?>" class="btn btn-success">New Image</a></p>
		</div>
		<?php if($this->session->flashdata('dataImage') == TRUE): ?>
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<h3>Information Images</h3>
			<hr />
			<ul>
				<?php foreach($this->session->flashdata('dataImage') as $key => $value): ?>
					<li><strong><?php echo $key?></strong> => <?php echo $value?></li>
				<?php endforeach; ?>
			</ul>
			<hr/>
			<h3>Information image after drop</h3>
			<hr />
			<ul>
				<?php foreach($this->session->flashdata('dataCrop') as $key => $value): ?>
					<li><strong><?php echo $key;?></strong> => <?php echo $value;?></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
	</div>
</div>

<?php $this->load->view('commons/footer_upload'); ?>
