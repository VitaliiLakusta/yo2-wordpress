<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{

	echo 'HELLO FROM THE SERVER [PHP]: I WAS SUPPOSED TO MAKE ALL API CALLS TO WOOCOMMERCE AND MAKE THE PAYMENT - COOL!';
	echo $_POST['data'];
	// echo "$_POST['data']" .  $_POST['data'];

}


?>