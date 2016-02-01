<header class="clearfix">
	<a href="<?= base_url('index.php') ;?>" class="pull-left logo"><img class="logo" src="<?php echo asset_url();?>images/logo.jpg"></a>
	<ul class="nav navbar-nav">
		<li id="nav-home"><a href="<?= base_url('index.php') ;?>">Home</a></li>	
	</ul>
	<ul class="nav navbar-nav pull-right">
		<?php
			if($this->session->userdata('logged_in') == TRUE){
				?>

		<li><a href=<?= base_url("index.php/user/logout/") ;?>>Logout</a></li>
			<?php } else {
		?>
		<li><a href=<?= base_url("index.php/user/login/") ;?>>Login</a></li>
		<li><a href=<?= base_url("index.php/user/register/") ;?>>Register</a></li>
		<?php } ?>
	</ul>
</header>