<?php

require '../../vendor/autoload.php';
require '../../config/config.php';
require '../../admin/classes/Admin.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;


$key = JWT_SECRET; 

// Đặt header để trả về dữ liệu JSON
header('Content-Type: application/json');
    
// Đọc dữ liệu từ yêu cầu POST
$input = file_get_contents('php://input');

// Giải mã dữ liệu JSON
$dataClient = json_decode($input, true);

// tạo biến
$email = $dataClient['email'];
$password = md5($dataClient['password']);

// trang thai
$status = '';
$dataJWT = [];

// // lấy dữ liệu data check account
$admin = new Admin();
$rows = $admin -> checkAdmin($email , $password);
// print_r($rows);

if($rows) {
    $status = 'success';
    // lấy  dữ liệu tạo token
    $dataJWT = [
        'id_admin' => $rows['id_admin'],    
        'email' => $rows['email'],
        'name' => $rows['name'],
        'role' => $rows['role']
    ];
}else{
    $status = 'acccount erorr';
}


$payload = [
    "iss" => JWT_ISSUER,
    "aud" => JWT_AUDIENCE,
    "iat" => time(),
    "nbf" => time(),
    "expr" => time() + 3600,
     "dataUser" => $dataJWT
];


$jwt = JWT::encode($payload, $key, 'HS256');

echo json_encode([
    'status' => $status,
    'token' => $jwt,
]);

?>