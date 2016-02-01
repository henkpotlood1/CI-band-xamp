		<div class="main-body">
				<h2>Login</h2>
				<?php
					$this->load->helper('security');
					echo validation_errors();
					echo form_open('user/login/');
				?>	
				<div class="control-group">
					<label class="control-label">Username</label>
					<div class="controls">
						<input name="userName" type="text" placeholder="Username">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Password</label>
					<div class="controls">
						<input name="password" type="password" placeholder="password">
					</div>
				</div>
				<div class="form-actions">
					<button type="submit" class="btn btn-success">Login</button>
					<a class="btn" href=<?=base_url() ;?>>Back</a>
				</div>
			</div>