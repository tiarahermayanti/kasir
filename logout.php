<?php
session_start();
setcookie("message","delete",time()-1);
session_destroy();
header('location:./')
 ?>
