<?php
	if (! defined(BASEPATH)) exit('no direct script allowed');

		if(! function_exists('bands_url()'))
		{
			function bands_url()
			{
				return base_url().'/application/views/';
			}
		}