<?php

    

    class Bank{

        
        public function checkOutSp($data){
            // error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
            // date_default_timezone_set('Asia/Ho_Chi_Minh');

             $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
             $vnp_Returnurl = "https://localhost:80/thanks.php";
            // $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";

    
             $vnp_TmnCode = "9IZWFV0M";//Mã website tại VNPAY test 
             $vnp_HashSecret = "NYAOQSMYGXICJJZGEGJBGRZMXQBXAXPR"; //Chuỗi bí mật
    

            $vnp_TxnRef = $data['order_id']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Nap tien cho thue bao 0868337741. So tien 100,000 VND';//$data['order_desc']; // chi tiết đơn hàng tên , hình ảnh ...
            $vnp_OrderType = 'other';//$data['order_type']; // Mã danh mục hàng hóa , sản phẩm 
            $vnp_Amount = $data['amount'] * 100; // Số tiền thanh toán ( 100000 * 100 )
            $vnp_Locale = 'vn';//$data['language']; // ngôn ngữ ( vd : Viêt Nam )
            // $vnp_BankCode = 'QR'; // $data['bank_code'];  // Xuất hiện chọn phương thức thanh toán ( tất cả : QR CODE , NỘI ĐỊA , QUỐC TẾ , VNPAY)
            $vnp_BankCode = 'VIETINBANK'; // $data['bank_code'];  //Mã Ngân hàng thanh toán nội địa. Ví dụ: NCB
            // $vnp_BankCode = 'VISA'; // $data['bank_code'];   //Mã Ngân hàng thanh toán quốc tế . Ví dụ: VISA
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; // địa chỉ web test hiện tại (zing-mp3) 127.0.0.1
            //Add Params of 2.0.1 Version
            // $vnp_ExpireDate = $data['txtexpire']; // tạo phiên thanh toán trong khoảng 15 phút , hết 15 phút là hủy phiên thanh toán

            //Billing ( khi nào cần thêm thuộc tính nào thì thêm vào )
            // $vnp_Bill_Mobile = $data['txt_billing_mobile'];
            // $vnp_Bill_Email = $data['txt_billing_email'];
            // $fullName = trim($data['txt_billing_fullname']);
            // if (isset($fullName) && trim($fullName) != '') {
            //     $name = explode(' ', $fullName);
            //     $vnp_Bill_FirstName = array_shift($name);
            //     $vnp_Bill_LastName = array_pop($name);
            // }
            // $vnp_Bill_Address=$data['txt_inv_addr1'];
            // $vnp_Bill_City=$data['txt_bill_city'];
            // $vnp_Bill_Country=$data['txt_bill_country'];
            // $vnp_Bill_State=$data['txt_bill_state'];

            // // Invoice
            // $vnp_Inv_Phone=$data['txt_inv_mobile'];
            // $vnp_Inv_Email=$data['txt_inv_email'];
            // $vnp_Inv_Customer=$data['txt_inv_customer'];
            // $vnp_Inv_Address=$data['txt_inv_addr1'];
            // $vnp_Inv_Company=$data['txt_inv_company'];
            // $vnp_Inv_Taxcode=$data['txt_inv_taxcode'];
            // $vnp_Inv_Type=$data['cbo_inv_type'];


            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
                // "vnp_ExpireDate"=>$vnp_ExpireDate,

                // "vnp_Bill_Mobile"=>$vnp_Bill_Mobile,
                // "vnp_Bill_Email"=>$vnp_Bill_Email,
                // "vnp_Bill_FirstName"=>$vnp_Bill_FirstName,
                // "vnp_Bill_LastName"=>$vnp_Bill_LastName,
                // "vnp_Bill_Address"=>$vnp_Bill_Address,
                // "vnp_Bill_City"=>$vnp_Bill_City,
                // "vnp_Bill_Country"=>$vnp_Bill_Country,
                // "vnp_Inv_Phone"=>$vnp_Inv_Phone,
                // "vnp_Inv_Email"=>$vnp_Inv_Email,
                // "vnp_Inv_Customer"=>$vnp_Inv_Customer,
                // "vnp_Inv_Address"=>$vnp_Inv_Address,
                // "vnp_Inv_Company"=>$vnp_Inv_Company,
                // "vnp_Inv_Taxcode"=>$vnp_Inv_Taxcode,
                // "vnp_Inv_Type"=>$vnp_Inv_Type
            );

            // if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            //     $inputData['vnp_BankCode'] = $vnp_BankCode;
            // }
            // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            //     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            // }

            //var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array(
                'code' => '00'
                , 'message' => 'success'
                , 'data' => $vnp_Url
            );
            if (isset($data['paymethod'])) {
                // check click vào button nào điều hướng đến đấy
                header('Location: ' . $vnp_Url);
                die();
            } 
            else if (isset($data['redirect'])) {
                // check click vào button nào điều hướng đến đấy
                // header('Location: ' . $vnp_Url);
                echo json_encode($returnData);

                die();
            }else {
                echo json_encode($returnData);
            }
                // vui lòng tham khảo thêm tại code demo
        }

        public function checkIPN(){
            
            /* Payment Notify
            * IPN URL: Ghi nhận kết quả thanh toán từ VNPAY
            * Các bước thực hiện:
            * Kiểm tra checksum 
            * Tìm giao dịch trong database
            * Kiểm tra số tiền giữa hai hệ thống
            * Kiểm tra tình trạng của giao dịch trước khi cập nhật
            * Cập nhật kết quả vào Database
            * Trả kết quả ghi nhận lại cho VNPAY
            */

            // require_once("./config.php");
            $inputData = array();
            $returnData = array();

            foreach ($_GET as $key => $value) {
                if (substr($key, 0, 4) == "vnp_") {
                    $inputData[$key] = $value;
                }
            }

            $vnp_SecureHash = $inputData['vnp_SecureHash'];
            unset($inputData['vnp_SecureHash']);
            ksort($inputData);
            $i = 0;
            $hashData = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
            }

            $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
            $vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
            $vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
            $vnp_Amount = $inputData['vnp_Amount']/100; // Số tiền thanh toán VNPAY phản hồi

            $Status = 0; // Là trạng thái thanh toán của giao dịch chưa có IPN lưu tại hệ thống của merchant chiều khởi tạo URL thanh toán.
            $orderId = $inputData['vnp_TxnRef'];

            try {
                //Check Orderid    
                //Kiểm tra checksum của dữ liệu
                if ($secureHash == $vnp_SecureHash) {
                    //Lấy thông tin đơn hàng lưu trong Database và kiểm tra trạng thái của đơn hàng, mã đơn hàng là: $orderId            
                    //Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch
                    //Giả sử: $order = mysqli_fetch_assoc($result);   

                    $order = NULL;
                    if ($order != NULL) {
                        if($order["Amount"] == $vnp_Amount) //Kiểm tra số tiền thanh toán của giao dịch: giả sử số tiền kiểm tra là đúng. //$order["Amount"] == $vnp_Amount
                        {
                            if ($order["Status"] != NULL && $order["Status"] == 0) {
                                if ($inputData['vnp_ResponseCode'] == '00' || $inputData['vnp_TransactionStatus'] == '00') {
                                    $Status = 1; // Trạng thái thanh toán thành công
                                } else {
                                    $Status = 2; // Trạng thái thanh toán thất bại / lỗi
                                }
                                //Cài đặt Code cập nhật kết quả thanh toán, tình trạng đơn hàng vào DB
                                //
                                //
                                //
                                //Trả kết quả về cho VNPAY: Website/APP TMĐT ghi nhận yêu cầu thành công                
                                $returnData['RspCode'] = '00';
                                $returnData['Message'] = 'Confirm Success';
                            } else {
                                $returnData['RspCode'] = '02';
                                $returnData['Message'] = 'Order already confirmed';
                            }
                        }
                        else {
                            $returnData['RspCode'] = '04';
                            $returnData['Message'] = 'invalid amount';
                        }
                    } else {
                        $returnData['RspCode'] = '01';
                        $returnData['Message'] = 'Order not found';
                    }
                } else {
                    $returnData['RspCode'] = '97';
                    $returnData['Message'] = 'Invalid signature';
                }
            } catch (Exception $e) {
                $returnData['RspCode'] = '99';
                $returnData['Message'] = 'Unknow error';
            }
            //Trả lại VNPAY theo định dạng JSON
            echo json_encode($returnData);
        }

    }