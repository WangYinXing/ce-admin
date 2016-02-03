<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

<?php 
/*
	header and side menu....
*/
	$this->view('Common/header');

	?>


<body class="hold-transition skin-blue">
	<div class="wrapper">

		<?php
			$this->view('Common/banner');
			$this->view('Common/sidemenu');

		/*
			Load page contents....
		*/
			$this->view($view);
		?>


		<?php $this->view('Common/footer') ?>
	</div>
</body>
</html>