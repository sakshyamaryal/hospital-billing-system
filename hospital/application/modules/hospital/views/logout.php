<?php   
  if(isset($_SESSION['username'])){
    session_destroy();
    header('location:'.base_url().'hospital/admin');
}
  ?>