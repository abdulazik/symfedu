<?php

$code = $_POST['code'];
$xml = file_get_contents('C:\op\OpenServer\domains\localhost\qr\src\AppBundle\Controller\GenController.php?code='.$code);

?>