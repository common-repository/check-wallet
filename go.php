<?php
if(isset($_GET['processor'])){
	if($_GET['processor'] == 0 ){
		header("Location: ".$_SERVER['HTTP_REFERER']);
	} else if($_GET['processor'] == 1 ){
		header("Location: https://blockchain.info/address/".$_GET['address']);
	} else if($_GET['processor'] == 2 ){
		header("Location: https://faucetsystem.com/check/".$_GET['address']);
	} else if($_GET['processor'] == 3 ){
		header("Location: https://microwallet.org/?u=".$_GET['address']);
	} else if($_GET['processor'] == 4 ){
		header("Location: https://chain.so/address/BTC/".$_GET['address']);
	} else if($_GET['processor'] == 5 ){
		header("Location: https://faucethub.io/balance/".$_GET['address']."/balance");
	}
}
?>
