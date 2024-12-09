<?php

class profileModel extends DModel {
    public function __construct() {
        parent::__construct();
    }

    // Lấy thông tin người dùng từ bảng `users`
    public function getUserInfo($user_id) {
          // SQL query để lấy thông tin người dùng theo user_id
          $query = "SELECT * FROM users WHERE user_id = :user_id";
        
          // Sử dụng PDO để thực hiện truy vấn an toàn
          $stmt = $this->db->prepare($query);
          $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
          $stmt->execute();
          
          // Lấy kết quả và trả về
          return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getUserById($user_id) {
        // SQL query để lấy thông tin người dùng theo user_id
        $query = "SELECT * FROM users WHERE user_id = :user_id";
        
        // Sử dụng PDO để thực hiện truy vấn an toàn
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Lấy kết quả và trả về
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật thông tin người dùng  // Cập nhật thông tin người dùng
    public function updateUserInfo($data, $user_id) {
        // Lấy thông tin người dùng hiện tại để kiểm tra email cũ
        $currentUser = $this->getUserInfo($user_id);
        
        // Nếu email thay đổi, kiểm tra tính duy nhất của email mới
        if ($data['email'] !== $currentUser['email']) {
            $query = "SELECT COUNT(*) FROM users WHERE email = :email AND user_id != :user_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
    
            // Nếu email đã tồn tại cho người dùng khác, trả về false
            if ($stmt->fetchColumn() > 0) {
                return false; // Email đã tồn tại
            }
        }
    
        // Cập nhật thông tin người dùng trong database
        $sql = "UPDATE users SET full_name = :full_name, phone = :phone, email = :email, date_of_birth = :date_of_birth, gender = :gender, avatar = :avatar WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        
        // Execute statement
        $stmt->execute([
            'full_name' => $data['full_name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'date_of_birth' => $data['date_of_birth'],
            'gender' => $data['gender'],
            'avatar' => isset($data['avatar']) ? $data['avatar'] : null,  // Nếu có ảnh thì lưu đường dẫn
            'user_id' => $user_id
        ]);
    
        // Kiểm tra số dòng bị ảnh hưởng (cập nhật thành công)
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
}
?>
