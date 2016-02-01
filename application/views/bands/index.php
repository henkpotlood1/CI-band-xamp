	<div class="main-body">
		<table id="table" class="table table-striped table-bordered">
			<?php if ($this->session->userdata('logged_in') == true):?>
				<p>
					<a href="<?= base_url('index.php/bands/create') ;?>" class="btn btn-success" id="createButt">Create</a>
				</p>
			<?php endif ;?>
				<thead>
					<tr>
						<th>Band</th>
						<th>Wikipedia</th>
						<th>Website</th>
						<?php if($this->session->userdata('logged_in') == TRUE):?>
						<th>Action</th>
						<?php endif ;?>
					</tr>
				</head>
				<tbody>
					<?php foreach($band as $bands_item ) : ?>
							 <tr>
							 <td><?= $bands_item['bandname'] ;?></td>
							 <td><a href="<?= $bands_item['wikipedia'];?>">Wikipedia Page</a></td>
							 <td><a href="<?= $bands_item['website'] ;?>">Website</a></td>
								<?php if($this->session->userdata('logged_in') == TRUE)  :?>
							 <td width=250px>
							 <a class="btn btn-success" href= <?= base_url()."index.php/bands/update/". $bands_item['id'] ;?>>Update</a>
							 <a class="btn btn-danger" href= <?= base_url(). "index.php/bands/delete/". $bands_item['id'] ;?>>Delete</a>
								<?php endif ;?>
							 </tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>