  <?php
  session_start(); 
  $_SESSION['EMP_ID'];

  unset($_SESSION['EMP_ID']);
	unset($_SESSION['EMP_NAME']);
	unset($_SESSION['EMP_TYPE']);
	unset($_SESSION['sessionTime']);
	session_destroy();
	?>
    <script type="text/javascript">
        window.location.replace("../auth/index.html");
    </script>