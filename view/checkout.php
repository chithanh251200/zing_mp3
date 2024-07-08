<?php
    require_once '../classes/Bank.php';
    // echo "<pre>";
    // print_r($_SERVER);
    // echo "</pre>";

    // echo 'https://localhost/vnpay_php/vnpay_return.php?vnp_Amount=1000000&vnp_BankCode=VNPAY&vnp_CardType=QRCODE&vnp_OrderInfo=Nap+tien+cho+thue+bao+0123456789.+So+tien+100%2C000+VND&vnp_PayDate=20240220234635&vnp_TmnCode=9IZWFV0M&vnp_TransactionNo=0&vnp_TransactionStatus=02&vnp_TxnRef=812&vnp_SecureHash=0b983bbcea5c59204286867f83a056fcea1c41019e5384cf5bb9f049b12979909e4f32b2a0005f55d1f89ecb6dd050045741facb9fc6645f1ba16b7fe1998524';


    if(isset($_POST['redirect'])){

        $bank = new Bank();
        $bank -> checkOutSp($_POST);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="ewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Thanh toán hóa đơn sản phẩm</h1>
    <form action="checkout.php" method="POST">
       
        <label for="order_id">Mã đơn hàng</label>
        <input type="text" value="10" name="order_id"><br>

        <label for="order_desc">Chi tiết sản phẩm</label>
        <input type="text" value="áo" name="order_desc"><br>

        <label for="amount">Giá thành sản phẩm</label>
        <input type="text" value="10000" name="amount"><br>

        <label for="txt_inv_mobile">Số điện thoai</label>
        <input type="text" value="0868337741" name="txt_inv_mobile"><br>
        
        <input type="submit" name="redirect" value="Thanh toán visa">


        
    </form>
</body>
</html>