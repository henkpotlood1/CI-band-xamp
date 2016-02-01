			<div class="main-body">
				<h2>Register</h2>
				<?php 
					$this->load->helper('security');
					echo validation_errors();
					echo form_open('user/register/');
				?>
				<div class="control-group">
					<label class="control-label">Username</label>
					<div class="controls">
						<input name="userName" type="text" placeholder="Username">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Email</label>
					<div class="controls">
						<input name="email" type="text" placeholder="Email">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Password</label>
					<div class="controls">
						<input name="password" type="password" placeholder="Password">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Password Confirmation</label>
					<div class="controls">
						<input name="passwordVal" type="password" placeholder="Password Confirmation">
					</div>
				</div>
				<div class="form-actions">
					<button type="submit" class="btn btn-success">Register</button>
					<a class="btn" href=<?=base_url() ;?>>Back</a>
				</div>
			</div>