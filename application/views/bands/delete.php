<div class="main-body">
			<div class="span10 offset1">
			<?php foreach($band as $bands_item) :?>	
				<h3>Delete <?= $bands_item->bandname;?></h3>
			</div>
			<!--<form class="form-horizontal">-->
				<?php echo form_open('pages/delete/'.$bands_item->id) ;?>
				<p class="alert alert-error"> Are you sure you want to delete <?= $bands_item->bandname ;?>?</p>
					<input value="yes" class="btn btn-danger" type="submit">
					<a class="btn" href="<?= base_url();?>">No</a>
			<?php endforeach ; ?>
			<!--</form>-->
		</div>