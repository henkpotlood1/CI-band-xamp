			<div class="main-body">
			<?php foreach($band as $bands_item) :?>
				<h3>Update <?= $bands_item->bandname;?>?</h3>
			<?php echo form_open('pages/update/'. $bands_item->id);?>
				<div class="control-group">
				<label class="control-label">Band name</label>
					<div class="controls">
						<input name="bandname" type="text" placeholder="Band name" value="<?= $bands_item->bandname ;?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Wikipedia</label>
					<div class="controls">
						<input name="wikipedia" type="text" placeholder="Wikipedia" value="<?= $bands_item->wikipedia ;?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Website</label>
					<div class="controls">
						<input name="website" type="text" placeholder="Website" value="<?= $bands_item->website ;?>">
					</div>
				</div>
				<div class="form-actions">
					<input value="Yes" class="btn btn-success" type="submit">
					<a class="btn btn-danger" href="<?=base_url() ;?>">No</a>
				</div>
			<?php endforeach ;?>
			</div>