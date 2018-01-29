<?php
/**
* @author xxxxxxxx
* @brief 简介：
* @date 15/9/2
* @time 下午5:00
*/
use \PayPal\Api\Payer;
use \PayPal\Api\Order;
use \PayPal\Api\Item;
use \PayPal\Api\ItemList;
use \PayPal\Api\Details;
use \PayPal\Api\Amount;
use \PayPal\Api\Transaction;
use \PayPal\Api\RedirectUrls;
use \PayPal\Api\Payment;
use \PayPal\Exception\PayPalConnectionException;

require "app/start.php"; 
	if (!isset($_POST['product'], $_POST['price'])) { 
		die("lose some params"); 
	} 
	$hl=convertCurrency("USD", "CNY", "1");
	$product = $_POST['product']; 
	$price = round($_POST['price']/$hl,2); 
	$shipping = 0.00; //运费 
	$total = $price + $shipping; 
	$payer = new Payer(); 
	$payer->setPaymentMethod('paypal'); //设置为信用卡支付
	$item = new Item(); 
	$item->setName($product) ->setCurrency('USD') ->setQuantity(1) ->setPrice($price) ->setSku('21324156456a');//设置商品名称 币种 数量 价钱 订单号
	$itemList = new ItemList(); 
	$itemList->setItems([$item]); 
	$details = new Details(); 
	$details->setShipping($shipping) ->setSubtotal($price); //设置运费 商品价钱
	$amount = new Amount(); 
	$amount->setCurrency('USD') ->setTotal($total) ->setDetails($details); //设置币种 收款总金额 额外信息
	$transaction = new Transaction(); 
	$transaction->setAmount($amount) ->setItemList($itemList) ->setDescription("des") ->setInvoiceNumber(uniqid())->setNotifyUrl(SITE_URL . '/payok.php'); //设置收集量 项目和相关运输地址 描述 发票号码（只有paypal方式才有用）
	$redirectUrls = new RedirectUrls(); 
	$redirectUrls->setReturnUrl(SITE_URL . '/pay.php?success=true') ->setCancelUrl(SITE_URL . '/pay.php?success=false'); //付款成功和失败后跳转的url
	$payment = new Payment(); 
	$payment->setIntent('sale') ->setPayer($payer) ->setRedirectUrls($redirectUrls) ->setTransactions([$transaction]); //设置付款的类型 付款方式 回调url 交易细节
	try { 
			$payment->create($paypal);
		} catch (PayPalConnectionException $e) { 
			echo $e->getData(); die(); 
		} 
	$approvalUrl = $payment->getApprovalLink();
	header("Location: {$approvalUrl}");
//人民币美元汇率换算
function convertCurrency($from, $to, $amount){
  $data = file_get_contents("http://www.baidu.com/s?wd={$from}%20{$to}&rsv_spt={$amount}");
  preg_match("/<div>1\D*=(\d*\.\d*)\D*<\/div>/",$data, $converted);
  $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
  return number_format(round($converted, 3), 1);
}
