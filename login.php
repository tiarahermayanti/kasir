<head>
<title></title>
</head>
<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<body>
<?php
session_start();
//Koneksi sederhana dengan PDO
require "config/koneksi_ajax.php";

if (isset($_POST['login'])){
     $user=$_POST['user'];
     $pass=md5($_POST['pass']);

     $query=$con->prepare("select * from ak where username=:user and password=:pass");
     $query->BindParam(":user",$user);
     $query->BindParam(":pass",$pass);
     $query->execute();
     if ($query->rowCount()>0){
           setcookie("message","delete",time()-1);
           $data=$query->fetch();
           if($data['level']=="Admin"){
                 $_SESSION['username']=$data['username'];
                 $_SESSION['nama']=$data['name'];
                 $_SESSION['level']=$data['level'];
                 header('location:admin/');
           }elseif($data['level']=="Kasir"){
                 $_SESSION['username']=$data['username'];
                 $_SESSION['nama']=$data['name'];
                 $_SESSION['level']=$data['level'];
                 header('location:kasir/');
           }else {
             // code...
             echo "<script>
       			swal('Oopzz!', 'Username atau Password anda Salah..!', {
       				icon : 'error',
       				buttons: {
       					confirm: {
       						className : 'btn btn-danger'
       					}
       				},
       			}).then(function(){
      				window.location='./';
      			});
       			</script>";
           }
     }
     else{
       echo "<script>
 			swal('Oopzz!', 'Username atau Password anda Salah..!', {
 				icon : 'error',
 				buttons: {
 					confirm: {
 						className : 'btn btn-danger'
 					}
 				},
 			}).then(function(){
				window.location='./';
			});
 			</script>";
     }
}else{
  header('location:./');
}


?>
