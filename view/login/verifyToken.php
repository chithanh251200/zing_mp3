<?php
    require '../../vendor/autoload.php';
    require '../../config/config.php';
    require '../../admin/classes/Admin.php';

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    // Đặt header để trả về dữ liệu JSON
    header('Content-Type: application/json');

    $headers = getallheaders();

    $key = JWT_SECRET; 
    $authHeader = $headers['Authorization'];

    if ($authHeader) {
        list($jwt) = sscanf($authHeader, 'Bearer %s');

        if ($jwt) {
            try {
                $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
                // print_r($decoded->dataUser->name);
                $decoded_array = (array) $decoded;


                // Thiết lập cookie bằng cách sử dụng hàm setcookie()
                // Tên cookie (name): Tên của cookie bạn muốn thiết lập.
                // Giá trị (value): Giá trị của cookie.
                // Hạn sử dụng (expire): Thời gian hết hạn của cookie, được tính bằng số giây kể từ thời điểm hiện tại. Nếu không thiết lập, cookie sẽ hết hạn khi phiên làm việc của người dùng kết thúc (tức là khi trình duyệt đóng).
                // Đường dẫn (path): Đường dẫn trên máy chủ mà cookie có sẵn. Mặc định là '/' (tất cả các đường dẫn).
                // Miền (domain): Miền của cookie. Mặc định là rỗng, có nghĩa là cookie sẽ chỉ có sẵn cho miền mà nó được tạo ra.
                // Bảo mật (secure): Nếu được thiết lập thành true, cookie chỉ được gửi qua giao thức HTTPS.
                // HTTP Only (httponly): Nếu được thiết lập thành true, cookie chỉ có thể được truy cập bằng HTTP và không thể truy cập từ JavaScript.
                setcookie('accountLogin', $decoded->dataUser->name , time() + 120,  '/', 'localhost', true,  true);
                
                // Xử lý yêu cầu API bảo mật ở đây
                echo json_encode([
                    "status" => "success",
                    "data" => $decoded_array
                ]);
            } catch (Exception $e) {
                echo json_encode([
                    "status" => "error",
                    "message" => "Invalid token"
                ]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Bearer token not found"
            ]);
        }
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Authorization header not found"
        ]);
    }

?>