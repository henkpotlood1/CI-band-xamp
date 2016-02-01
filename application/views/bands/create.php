	<div class="main-body">
		<div class="container">
			<div class="span10 offset1">
				<h3>Create new info</h3>
			</div>
				<?php 
					echo validation_errors();
					echo form_open('index.php/bands/create');
				?>
				<div class="control-group">
				<label class="control-label">Band Name</label>
					<div class="controls">
						<input name="bandName" type="text" placeholder="Band Name">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Wikipedia</label>
					<div class="controls">
						<input name="wikipedia" type="text" placeholder="Wikipedia">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Website</label>
					<div class="controls">
						<input name="website" type="text" placeholder="Website">
					</div>
				</div>
				<div class="form-actions">
					<button type="submit" class="btn btn-success">Create</button>
					<a class="btn" href="<?= base_url('index.php') ;?>">Back</a>
				</div>
		</div>
	</div>