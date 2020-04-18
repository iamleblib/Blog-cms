<?php 

if (isset($_GET['cate'])) {
  $cate = $_GET['cate'];
  catPostDisplay($cate);
} else if (isset($_POST['search'])) {
  $searched = $_POST['search'];
  searched($searched);
} else {
   displayPost();
}