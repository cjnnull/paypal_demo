<?php
require 'app/start.php';

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

if(!isset($_GET['success'], $_GET['paymentId'], $_GET['PayerID'])){
    die();
}

if((bool)$_GET['success']=== 'false'){

    echo 'Transaction cancelled!';
    die();
}

$paymentID = $_GET['paymentId'];
$payerId = $_GET['PayerID'];

$payment = Payment::get($paymentID, $paypal);

$execute = new PaymentExecution();
$execute->setPayerId($payerId);

try{
    $result = $payment->execute($execute, $paypal);
}catch(Exception $e){
    die($e);
}
echo "<pre>";print_r($result);echo "<pre>";
echo 'ok!';


/*
PayPal\Api\Payment Object
(
    [_propMap:PayPal\Common\PayPalModel:private] => Array
        (
            [id] => PAY-36C85132TM199821CLJSUYBY
            [intent] => sale
            [state] => approved
            [cart] => 6R963479NN9720413
            [payer] => PayPal\Api\Payer Object
                (
                    [_propMap:PayPal\Common\PayPalModel:private] => Array
                        (
                            [payment_method] => paypal
                            [status] => VERIFIED
                            [payer_info] => PayPal\Api\PayerInfo Object
                                (
                                    [_propMap:PayPal\Common\PayPalModel:private] => Array
                                        (
                                            [email] => buy8532-buyer@163.com
                                            [first_name] => test
                                            [last_name] => buyer
                                            [payer_id] => QJNGFBGZXDX56
                                            [shipping_address] => PayPal\Api\ShippingAddress Object
                                                (
                                                    [_propMap:PayPal\Common\PayPalModel:private] => Array
                                                        (
                                                            [recipient_name] => test buyer
                                                            [line1] => NO 1 Nan Jin Road
                                                            [city] => Shanghai
                                                            [state] => Shanghai
                                                            [postal_code] => 200000
                                                            [country_code] => C2
                                                        )

                                                )

                                            [country_code] => C2
                                        )

                                )

                        )

                )

            [transactions] => Array
                (
                    [0] => PayPal\Api\Transaction Object
                        (
                            [_propMap:PayPal\Common\PayPalModel:private] => Array
                                (
                                    [amount] => PayPal\Api\Amount Object
                                        (
                                            [_propMap:PayPal\Common\PayPalModel:private] => Array
                                                (
                                                    [total] => 0.16
                                                    [currency] => USD
                                                    [details] => PayPal\Api\Details Object
                                                        (
                                                            [_propMap:PayPal\Common\PayPalModel:private] => Array
                                                                (
                                                                    [subtotal] => 0.16
                                                                    [shipping] => 0.00
                                                                )

                                                        )

                                                )

                                        )

                                    [payee] => PayPal\Api\Payee Object
                                        (
                                            [_propMap:PayPal\Common\PayPalModel:private] => Array
                                                (
                                                    [merchant_id] => 6QK9RX79UEBMQ
                                                    [email] => buy8532-facilitator@163.com
                                                )

                                        )

                                    [description] => æ”¯ä»˜æè¿°å†…å®¹
                                    [invoice_number] => 5a654c0094ce2
                                    [item_list] => PayPal\Api\ItemList Object
                                        (
                                            [_propMap:PayPal\Common\PayPalModel:private] => Array
                                                (
                                                    [items] => Array
                                                        (
                                                            [0] => PayPal\Api\Item Object
                                                                (
                                                                    [_propMap:PayPal\Common\PayPalModel:private] => Array
                                                                        (
                                                                            [name] => aaaaaaaa
                                                                            [sku] => 21324156456a
                                                                            [price] => 0.16
                                                                            [currency] => USD
                                                                            [quantity] => 1
                                                                        )

                                                                )

                                                        )

                                                    [shipping_address] => PayPal\Api\ShippingAddress Object
                                                        (
                                                            [_propMap:PayPal\Common\PayPalModel:private] => Array
                                                                (
                                                                    [recipient_name] => buyer test
                                                                    [line1] => NO 1 Nan Jin Road
                                                                    [city] => Shanghai
                                                                    [state] => Shanghai
                                                                    [postal_code] => 200000
                                                                    [country_code] => C2
                                                                )

                                                        )

                                                )

                                        )

                                    [related_resources] => Array
                                        (
                                            [0] => PayPal\Api\RelatedResources Object
                                                (
                                                    [_propMap:PayPal\Common\PayPalModel:private] => Array
                                                        (
                                                            [sale] => PayPal\Api\Sale Object
                                                                (
                                                                    [_propMap:PayPal\Common\PayPalModel:private] => Array
                                                                        (
                                                                            [id] => 9A491375VD272042P
                                                                            [state] => completed
                                                                            [amount] => PayPal\Api\Amount Object
                                                                                (
                                                                                    [_propMap:PayPal\Common\PayPalModel:private] => Array
                                                                                        (
                                                                                            [total] => 0.16
                                                                                            [currency] => USD
                                                                                            [details] => PayPal\Api\Details Object
                                                                                                (
                                                                                                    [_propMap:PayPal\Common\PayPalModel:private] => Array
                                                                                                        (
                                                                                                            [subtotal] => 0.16
                                                                                                        )

                                                                                                )

                                                                                        )

                                                                                )

                                                                            [payment_mode] => INSTANT_TRANSFER
                                                                            [protection_eligibility] => ELIGIBLE
                                                                            [protection_eligibility_type] => ITEM_NOT_RECEIVED_ELIGIBLE,UNAUTHORIZED_PAYMENT_ELIGIBLE
                                                                            [transaction_fee] => PayPal\Api\Currency Object
                                                                                (
                                                                                    [_propMap:PayPal\Common\PayPalModel:private] => Array
                                                                                        (
                                                                                            [value] => 0.16
                                                                                            [currency] => USD
                                                                                        )

                                                                                )

                                                                            [parent_payment] => PAY-36C85132TM199821CLJSUYBY
                                                                            [create_time] => 2018-01-22T02:28:00Z
                                                                            [update_time] => 2018-01-22T02:28:00Z
                                                                            [links] => Array
                                                                                (
                                                                                    [0] => PayPal\Api\Links Object
                                                                                        (
                                                                                            [_propMap:PayPal\Common\PayPalModel:private] => Array
                                                                                                (
                                                                                                    [href] => https://api.sandbox.paypal.com/v1/payments/sale/9A491375VD272042P
                                                                                                    [rel] => self
                                                                                                    [method] => GET
                                                                                                )

                                                                                        )

                                                                                    [1] => PayPal\Api\Links Object
                                                                                        (
                                                                                            [_propMap:PayPal\Common\PayPalModel:private] => Array
                                                                                                (
                                                                                                    [href] => https://api.sandbox.paypal.com/v1/payments/sale/9A491375VD272042P/refund
                                                                                                    [rel] => refund
                                                                                                    [method] => POST
                                                                                                )

                                                                                        )

                                                                                    [2] => PayPal\Api\Links Object
                                                                                        (
                                                                                            [_propMap:PayPal\Common\PayPalModel:private] => Array
                                                                                                (
                                                                                                    [href] => https://api.sandbox.paypal.com/v1/payments/payment/PAY-36C85132TM199821CLJSUYBY
                                                                                                    [rel] => parent_payment
                                                                                                    [method] => GET
                                                                                                )

                                                                                        )

                                                                                )

                                                                        )

                                                                )

                                                        )

                                                )

                                        )

                                )

                        )

                )

            [redirect_urls] => PayPal\Api\RedirectUrls Object
                (
                    [_propMap:PayPal\Common\PayPalModel:private] => Array
                        (
                            [return_url] => http://127.0.0.1/paypal/pay.php?success=true&paymentId=PAY-36C85132TM199821CLJSUYBY
                            [cancel_url] => http://127.0.0.1/paypal/pay.php?success=false
                        )

                )

            [create_time] => 2018-01-22T02:28:01Z
            [update_time] => 2018-01-22T02:27:58Z
            [links] => Array
                (
                    [0] => PayPal\Api\Links Object
                        (
                            [_propMap:PayPal\Common\PayPalModel:private] => Array
                                (
                                    [href] => https://api.sandbox.paypal.com/v1/payments/payment/PAY-36C85132TM199821CLJSUYBY
                                    [rel] => self
                                    [method] => GET
                                )

                        )

                )

        )

)
*/