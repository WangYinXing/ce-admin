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


<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<div class="loadingwheel">
		</div>
	</div>

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