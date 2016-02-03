<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

<?php 
/*
	header and side menu....
*/
	$this->view('vw_header');

	?>


<body class="hold-transition skin-blue">
	<div class="wrapper">

		<?php
			$this->view('vw_banner');
			$this->view('vw_sidemenu');

		/*
			Load page contents....
		*/
			$this->view($view);
		?>


		<?php $this->view('vw_footer') ?>
	</div>
</body>
</html>