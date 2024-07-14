<?php
    require_once '../admin/classes/Songs.php';

    // Đặt header để trả về dữ liệu JSON
    header('Content-Type: application/json');
    
    // Đọc dữ liệu từ yêu cầu POST
    $input = file_get_contents('php://input');
    
    // Giải mã dữ liệu JSON
    $data = json_decode($input, true);
    
    // print_r($data['name']);
    
    
    // // Kiểm tra nếu JSON được giải mã thành công
    if (json_last_error() === JSON_ERROR_NONE) {
        $name = $data['name'] ?? 'Unknown';

        $s = new Songs();
        $rows = $s -> getNames($name);
        // print_r($rows);
        
        // Tạo phản hồi
        $response = [
            'status' => 'success',
            'data' => $rows
            ];
        } else {
            // Xử lý lỗi nếu JSON không hợp lệ
            $response = [
                'status' => 'error',
                'message' => 'Invalid JSON input'
            ];
        }
        
    // // Trả về dữ liệu JSON
    echo json_encode($response);


    // chú ý cực kì quan trọng khi sử dụng fecth api + php trên cùng 1 file ( nếu sử fecth html và php cho 2 file riêng bị thì có đặt biến như  thường ở trang thái 1)
    // 1 : không được gán biến cho mã hóa về dạng json để trả về client thì nó sẽ không xuất phần html lên đc
        // $data = json_decode($input, true);
    // 2 : không return 1 biến gán cho json_encode => kết quả cũng không xuất phần html lên đc  
        // return json_encode(['data' => 'chithanh']);

    // ==> Chỉ có cách echo nó json_encode hoặc bỏ trống thì phần html mơi xuất hiện
        // echo json_encode(['data' => 'chithanh']);
        // json_encode(['data' => 'chithanh']);






    
    // echo json_encode(['data' => $rows]);
   
?>