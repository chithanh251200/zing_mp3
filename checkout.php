<?php
    include_once './classes/Bank.php';
    // echo "<pre>";
    // print_r($_SERVER);
    // echo "</pre>";

    echo 'https://localhost/vnpay_php/vnpay_return.php?vnp_Amount=1000000&vnp_BankCode=VNPAY&vnp_CardType=QRCODE&vnp_OrderInfo=Nap+tien+cho+thue+bao+0123456789.+So+tien+100%2C000+VND&vnp_PayDate=20240220234635&vnp_TmnCode=9IZWFV0M&vnp_TransactionNo=0&vnp_TransactionStatus=02&vnp_TxnRef=812&vnp_SecureHash=0b983bbcea5c59204286867f83a056fcea1c41019e5384cf5bb9f049b12979909e4f32b2a0005f55d1f89ecb6dd050045741facb9fc6645f1ba16b7fe1998524';


    if(isset($_POST['redirect']) || isset($_POST['paymethod'])){



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
    <form action="" method="post">
       
        <label for="order_id">Mã đơn hàng</label>
        <input type="text" value="999" name="order_id"><br>

        <label for="order_desc">Chi tiết sản phẩm</label>
        <input type="text" value="áo thun" name="order_desc"><br>

        <label for="amount">Giá thành sản phẩm</label>
        <input type="text" value="10000" name="amount"><br>

        <select name="" id="">
            <option value="">Chọn hình thức thanh toán</option>
            <option value="">Thanh toán VN BANK</option>
            <option value="">Thanh toán ngân hàng</option>
            <option value="">Thanh toán tại nhà</option>
        </select>

        <select name="bank_code" id="bank_code" class="form-control">
            <option value="">Không chọn</option>
            <option value="NCB"> Ngan hang NCB</option>
            <option value="AGRIBANK"> Ngan hang Agribank</option>
            <option value="SCB"> Ngan hang SCB</option>
            <option value="SACOMBANK">Ngan hang SacomBank</option>
            <option value="EXIMBANK"> Ngan hang EximBank</option>
            <option value="MSBANK"> Ngan hang MSBANK</option>
            <option value="NAMABANK"> Ngan hang NamABank</option>
            <option value="VNMART"> Vi dien tu VnMart</option>
            <option value="VIETINBANK">Ngan hang Vietinbank</option>
            <option value="VIETCOMBANK"> Ngan hang VCB</option>
            <option value="HDBANK">Ngan hang HDBank</option>
            <option value="DONGABANK"> Ngan hang Dong A</option>
            <option value="TPBANK"> Ngân hàng TPBank</option>
            <option value="OJB"> Ngân hàng OceanBank</option>
            <option value="BIDV"> Ngân hàng BIDV</option>
            <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
            <option value="VPBANK"> Ngan hang VPBank</option>
            <option value="MBBANK"> Ngan hang MBBank</option>
            <option value="ACB"> Ngan hang ACB</option>
            <option value="OCB"> Ngan hang OCB</option>
            <option value="IVB"> Ngan hang IVB</option>
            <option value="VISA"> Thanh toan qua VISA/MASTER</option>
        </select>
        
        <input type="submit" name="paymethod" value="Thanh toán visa">


        
    </form>
</body>
</html>