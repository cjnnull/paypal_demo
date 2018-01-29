<?php
require "vendor/autoload.php"; //载入sdk的自动加载文件 
define('SITE_URL', 'http://127.0.0.1/paypal'); //网站url自行定义
//创建支付对象实例 
$paypal = new \PayPal\Rest\ApiContext( new \PayPal\Auth\OAuthTokenCredential( 'Ae4Qdpn9Z7wbLW8Bqn-aG8k39mZCBXRvsVRdIqG3SJoMinlkt3NMxDfuBPzxKKj6vzF0wJVtr_3K5WlK','EOAjiN5XzOrqJbEnO6l3sc2wLjD3UlnXzE_q0w_DVFYnKuCpR3T66cyNSrC6P2ceassHQfTnAzZkgi8R'
    )
);