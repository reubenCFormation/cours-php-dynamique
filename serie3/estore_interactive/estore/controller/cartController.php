<?php
require('../database/queries.php');
require('../database/cart_queries.php');
 $getUrl=$_SERVER["REQUEST_URI"];
 $findLastOccurence=strrchr($getUrl,"/");



?>