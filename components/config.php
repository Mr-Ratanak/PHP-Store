<?php
    require_once 'connect.php';
    
    class Database extends Config{
        
        public function admin_login($name,$password){
            $sql=$this->connect->prepare('SELECT * FROM admins WHERE name= ? and password= ?');
            $sql->execute([$name,$password]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        public function select_admin($admin_id){
            $sql = $this->connect->prepare('SELECT * FROM admins WHERE id= ?');
            $sql->execute([$admin_id]);
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        public function totalCount($tablename){
            $sql = $this->connect->prepare("SELECT * FROM $tablename");
            $sql->execute();
            $row = $sql->rowCount();
            return $row;
        }
        public function totalCountOrder($tablename){
            $sql = $this->connect->prepare("SELECT * FROM $tablename WHERE active=1");
            $sql->execute();
            $row = $sql->rowCount();
            return $row;
        }
        public function totalPending(){
            $total_pending = 0;
            $sql = $this->connect->prepare("SELECT * FROM orders WHERE payment_status= ? AND active=1");
            $sql->execute(['pending']);
            while($select_pending = $sql->fetch(PDO::FETCH_ASSOC)){
                $total_pending += $select_pending['total_price'];
            }
            return $total_pending;
        }
        public function totalCompleted(){
            $total_completed = 0;
            $sql = $this->connect->prepare("SELECT * FROM orders WHERE payment_status= ?");
            $sql->execute(['completed']);
            while($select_completed = $sql->fetch(PDO::FETCH_ASSOC)){
                $total_completed += $select_completed['total_price'];
            }
            return $total_completed;
        }
        public function registerAdmin($name,$password){
            $sql = $this->connect->prepare("INSERT INTO admins (name,password) VALUES (?,?)");
            $sql->execute([$name,$password]);
            return true;
        }
        public function updateAdminName($name,$admin_id){
            $sql = $this->connect->prepare("UPDATE `admins` SET name= ? WHERE id= ?");
            $sql->execute([$name,$admin_id]);
        }
        public function updateAdminProfile($password,$admin_id){
            $sql = $this->connect->prepare("UPDATE `admins` SET password= ? WHERE id= ?");
            $sql->execute([$password,$admin_id]);
            return true;
        }
        // product function 
        public function select_product_name($pro_name){
            $sql = $this->connect->prepare("SELECT * FROM `products` WHERE name= ?");
            $sql->execute([$pro_name]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        public function uploadProduct($pro_name,$category_id,$pro_detail,$pro_price,$image_01,$image_02,$image_03){
            $sql = $this->connect->prepare("INSERT INTO `products` (name,category_id,details,price,image_01,image_02,image_03) VALUES
            (?,?,?,?,?,?,?)");
            $sql->execute([$pro_name,$category_id,$pro_detail,$pro_price,$image_01,$image_02,$image_03]);
            return true;
        }
        public function fetchProductCat(){
            $sql = $this->connect->prepare("SELECT * FROM `categories` WHERE active=1 ORDER BY id DESC");
            $sql->execute();
            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
        public function fetchProduct(){
            $sql = $this->connect->prepare("SELECT products.*, categories.name AS category_name, categories.slug 
            FROM products 
            INNER JOIN categories 
            ON products.category_id = categories.id 
            WHERE products.active = 1
            ORDER BY products.id DESC");
            $sql->execute();
            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }

        public function delProduct($id){
            $sql = $this->connect->prepare("UPDATE `products` SET active=0 WHERE id= ?");
            $sql->execute([$id]);
            return true;
        }
        public function delProductCart($id){
            $sql = $this->connect->prepare("DELETE FROM `cart` WHERE id= ?");
            $sql->execute([$id]);
            return true;
        }
        public function delProductWishlist($id){
            $sql = $this->connect->prepare("DELETE FROM `wishlist` WHERE id= ?");
            $sql->execute([$id]);
            return true;
        }
        public function editProduct($id){
            $sql = $this->connect->prepare("SELECT * FROM `products` WHERE id= ?");
            $sql->execute([$id]);
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        public function updateProduct($id,$name,$category_id,$detail,$price){
            $sql = $this->connect->prepare("UPDATE `products` SET name= ?, category_id=?, details=?, 
            price=? WHERE id= ?");
            $sql->execute([$name,$category_id,$detail,$price,$id]);
            return true;
        }
        public function updateProductImage01($id,$image_01){
            $sql = $this->connect->prepare("UPDATE `products` SET image_01= ? WHERE id= ?");
            $sql->execute([$image_01,$id]);
            return true;
        }
        public function updateProductImage02($id,$image_02){
            $sql = $this->connect->prepare("UPDATE `products` SET image_02= ? WHERE id= ?");
            $sql->execute([$image_02,$id]);
            return true;
        }
        public function updateProductImage03($id,$image_03){
            $sql = $this->connect->prepare("UPDATE `products` SET image_03= ? WHERE id= ?");
            $sql->execute([$image_03,$id]);
            return true;
        }
        public function deleteAllProduct(){
            $sql = $this->connect->prepare("UPDATE `products` SET active=0");
            $sql->execute();
            return true;
        }
        public function selectCategory(){
            $sql = $this->connect->prepare("SELECT * FROM `categories` WHERE active=1 ORDER BY id DESC");
            $sql->execute();
            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
        // public function 

    // product order 
        public function displayOrder(){
            $sql = $this->connect->prepare("SELECT * FROM orders WHERE active= 1");
            $sql->execute();
            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
        public function checkOrderExists(){
            $sql = $this->connect->prepare("SELECT * FROM orders WHERE active=1");
            $sql->execute();
            $row = $sql->rowCount();
            return $row;
        }
        public function updatePaymentStatus($id,$payment_status){
            $sql = $this->connect->prepare("UPDATE `orders` SET payment_status = ? WHERE id= ?");
            $sql->execute([$id,$payment_status]);
            return true;
        }
        public function deleteOrder($id){
            $sql = $this->connect->prepare("UPDATE `orders` SET active= 0 WHERE id= ?");
            $sql->execute([$id]);
            return true;
        }
        public function delOrder($id){
            $sql = $this->connect->prepare("DELETE * FROM `orders` WHERE id= ?");
            $sql->execute([$id]);
            return true;
        }
        // admin account
        public function displayAdmin(){
            $sql = $this->connect->prepare("SELECT * FROM `admins` WHERE active=1");
            $sql->execute();
            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
        public function modifiedAdminAcc($id){
            $sql = $this->connect->prepare("UPDATE `admins` SET active=0 WHERE id= ?");
            $sql->execute([$id]);
            return true;
        }
        // users account 
        public function displayUsers(){
            $sql = $this->connect->prepare("SELECT * FROM `users` WHERE active=1");
            $sql->execute();
            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
        public function modifiedUserAcc($id){
            $sql = $this->connect->prepare("UPDATE `users` SET active=0 WHERE id= ?");
            $sql->execute([$id]);
            return true;
        }
       

        // message control 
        public function delMessage($id){
            $sql = $this->connect->prepare("DELETE * FROM `messages` WHERE id= ?");
            $sql->execute([$id]);
            return true;
        }
        public function displayMessages(){
            $sql = $this->connect->prepare("SELECT * FROM `messages`");
            $sql->execute();
            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
        public function removeMessages($id){
            $sql = $this->connect->prepare("DELETE FROM `messages` WHERE id= ?");
            $sql->execute([$id]);
            return true;
        }

        // category control 
        public function select_cetegories_name($name){
            $sql = $this->connect->prepare("SELECT * FROM `categories` WHERE name= ?");
            $sql->execute([$name]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        public function addCategory($name,$image,$slug){
            $sql = $this->connect->prepare("INSERT INTO `categories` (name,image,slug ) 
            VALUES(?,?,?)");
            $sql->execute([$name,$image,$slug]);
            return true;
        }
        public function displayCategory(){
            $sql = $this->connect->prepare("SELECT * FROM `categories` WHERE active=1");
            $sql->execute();
            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
        public function editCategory($id){
            $sql = $this->connect->prepare("SELECT * FROM `categories` WHERE id=?");
            $sql->execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        public function updateCategory($id,$name,$image,$slug){
            $sql = $this->connect->prepare("UPDATE `categories` SET name= ?, image=?, slug= ? WHERE id= ?");
            $sql->execute([$id,$name,$image,$slug]);
            return true;
        }
        public function deleteCategory($id){
            $sql = $this->connect->prepare("UPDATE `categories` SET active=0 WHERE id= ?");
            $sql->execute([$id]);
            return true;
        }


    }
?>