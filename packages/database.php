<?php
session_start();
try {
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
        // header("location:user_login.php");
    }
} catch (\Throwable $th) {
    throw $th;
}
    require_once 'connect.php';

    Class Database extends Connection{
        // cart and wishlist 
        public function countAllCart($user_id){
            $sql = $this->connect->prepare("SELECT * FROM `cart` WHERE user_id= ?");
            $sql->execute([$user_id]);
            $row = $sql->rowCount();
            return $row;
        }
        public function countAllWishlist($user_id){
            $sql = $this->connect->prepare("SELECT * FROM `wishlist` WHERE user_id= ?");
            $sql->execute([$user_id]);
            $row = $sql->rowCount();
            return $row;
        }
        public function select_product(){
            $sql = $this->connect->prepare("SELECT * FROM `products` WHERE active = 1 ORDER BY id DESC LIMIT 6");
            $sql->execute();
            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
        public function check_wishlist_exist($name,$user_id){
            $sql = $this->connect->prepare("SELECT * FROM `wishlist` WHERE name=? AND user_id= ? ");
            $sql->execute([$name,$user_id]);
            $result = $sql->rowCount();
            return $result;
        }
        public function check_cart_exist($name,$user_id){
            $sql = $this->connect->prepare("SELECT * FROM `cart` WHERE name=? AND user_id= ? ");
            $sql->execute([$name,$user_id]);
            $result = $sql->rowCount();
            return $result;
        }
        public function addToCart($pid,$name,$price,$qty,$image,$user_id){
            $sql = $this->connect->prepare("INSERT INTO `cart` (user_id,pid,name,price,quantity,image) VALUES(?,?,?,?,?,?)");
            $sql->execute([$pid,$name,$price,$qty,$image,$user_id]);
            return true;
        }
        public function addToWishlist($pid,$name,$price,$image,$user_id){
            $sql = $this->connect->prepare("INSERT INTO `wishlist` (user_id,pid,name,price,image) VALUES(?,?,?,?,?)");
            $sql->execute([$pid,$name,$price,$image,$user_id]);
            return true;
        }
        public function deleteWishlist($name,$user_id){
            $sql = $this->connect->prepare("DELETE FROM `wishlist` WHERE name= ? AND user_id= ?");
            $sql->execute([$name,$user_id]);
            return true;
        }

        // register control 
        public function user_register($name,$email,$password){
            $sql = $this->connect->prepare('INSERT INTO users (name,email,password) VALUES(?,?,?)');
            $sql->execute([$name,$email,$password]);
            return true;
        }

        // login control 
        public function check_user_exists($name,$email){
            $sql = $this->connect->prepare("SELECT * FROM `users` WHERE name=? AND email=?");
            $sql->execute([$name,$email]);
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        public function userLogin($email,$password){
            $sql = $this->connect->prepare("SELECT * FROM `users` WHERE email=? AND password=?");
            $sql->execute([$email,$password]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        // profile user 
        public function profileUser($user_id){
            $sql = $this->connect->prepare("SELECT * FROM `users` WHERE id= ?");
            $sql->execute([$user_id]);
            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
        public function updateUserProfile($user_id,$name,$email){
            try{
                $sql = $this->connect->prepare("UPDATE `users` SET name=?, email=? WHERE id=?");
                $sql->execute([$name,$email,$user_id]);
                return true;
            }catch(PDOException $e){
               echo 'ERROR: '.$e->getMessage();
               return false;
            }
        }
        public function updateProfilePassword($password,$user_id){
            $sql = $this->connect->prepare("UPDATE `users` SET password=? WHERE id= ?");
            $sql->execute([$password,$user_id]);
            return true;
        }

        // category 
        public function displayCategory(){
           try{
                $sql = $this->connect->prepare('SELECT * FROM `categories` WHERE active=1');
                $sql->execute();
                $row = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $row;
           }catch(PDOException $e){
            echo 'ERROR : '.$e->getMessage();
            return false;
           }
        }
        public function getIdActive($table,$id){
            $sql = $this->connect->prepare('SELECT * FROM  $table WHERE active= 1');
            $sql->execute();
            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
        public function getSlugActive($table,$slug){
            $sql = $this->connect->prepare("SELECT * FROM  $table WHERE slug='$slug' AND active=1 LIMIT 1");
            $sql->execute();
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        public function getProByCategory($category_id){
            $sql = $this->connect->prepare("SELECT * FROM  `products` WHERE category_id='$category_id' AND active=1");
            $sql->execute();
            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
        public function countProByCategory($category_id){
            $sql = $this->connect->prepare("SELECT * FROM  `products` WHERE category_id='$category_id' AND active=1");
            $sql->execute();
            $row = $sql->rowCount();
            return $row;
        }

        // detail control 
        public function getIdDetail($table,$pid){
            $sql = $this->connect->prepare("SELECT * FROM  $table WHERE id='$pid' AND active=1 LIMIT 1");
            $sql->execute();
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        public function getProDetails($cid){
            $sql = $this->connect->prepare("SELECT * FROM  `products` WHERE id= ? AND active=1");
            $sql->execute([$cid]);
            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
        // shop control 
        public function displayProduct(){
            $sql = $this->connect->prepare("SELECT * FROM  `products` WHERE active=1 ORDER BY id DESC");
            $sql->execute();
            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
        public function check_ProExist(){
            $sql = $this->connect->prepare("SELECT * FROM  `products` WHERE active=1");
            $sql->execute();
            $row = $sql->rowCount();
            return $row;
        }
        // contact 
        public function check_messageExists($name,$email,$number,$message){
            $sql = $this->connect->prepare("SELECT * FROM `messages` WHERE name= ? AND email=? 
            AND number= ? AND message= ?");
            $sql->execute([$name,$email,$number,$message]);
            $result = $sql->rowCount();
            return $result;
        }
        public function sendMessage($name,$email,$number,$message){
            $sql = $this->connect->prepare("INSERT INTO `messages` (name,email,number,message)
            VALUES (?,?,?,?)");
            $sql->execute([$name,$email,$number,$message]);
            return true;
        }
        // search 
        public function searchExisting(){
            $sql = $this->connect->prepare("SELECT * FROM `products`");
            $sql->execute();
            $result = $sql->rowCount();
            return $result;
        }
        public function searchAllEngine($searchBox){
            $sql = $this->connect->prepare("SELECT products.*, categories.name AS category_name FROM products
                LEFT JOIN categories ON products.category_id = categories.id
                WHERE categories.active=1 AND products.name LIKE :search OR categories.name LIKE :search");
            $searchTerm = '%' . $searchBox . '%';
            $sql->bindParam(':search', $searchTerm);
            $sql->execute();
            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
        // wishlist 
        public function checkExistingWishlist($user_id){
            $sql = $this->connect->prepare("SELECT * FROM  `wishlist` WHERE user_id= ?");
            $sql->execute([$user_id]);
            $row = $sql->rowCount();
            return $row;
        }
        public function displayWishlist($user_id){
            $sql = $this->connect->prepare("SELECT * FROM  `wishlist` WHERE user_id= ?");
            $sql->execute([$user_id]);
            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
        public function removeWish($id){
            $sql = $this->connect->prepare("DELETE FROM `wishlist` WHERE id= ?");
            $sql->execute([$id]);
            return true;
        }
        public function removeAllWish($user_id){
            $sql = $this->connect->prepare("DELETE FROM `wishlist` WHERE user_id= ?");
            $sql->execute([$user_id]);
            return true;
        }

        // cart 
        public function displayCarts($user_id){
            $sql = $this->connect->prepare("SELECT * FROM  `cart` WHERE user_id= ?");
            $sql->execute([$user_id]);
            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
        public function checkExistingCarts($user_id){
            $sql = $this->connect->prepare("SELECT * FROM  `cart` WHERE user_id= ?");
            $sql->execute([$user_id]);
            $row = $sql->rowCount();
            return $row;
        }
        public function updateCartQty($qty,$id){
            $sql = $this->connect->prepare("UPDATE `cart` SET quantity=? WHERE id= ?");
            $sql->execute([$qty,$id]);
            return true;
        }
        public function removeItemCart($id){
            $sql = $this->connect->prepare("DELETE FROM `cart` WHERE id= ?");
            $sql->execute([$id]);
            return true;
        }
        public function removeAllItemCarts($user_id){
            $sql = $this->connect->prepare("DELETE FROM `cart` WHERE user_id= ?");
            $sql->execute([$user_id]);
            return true;
        }
        // checkout control 
        public function checkExistingOrders($user_id,$name,$number,$email){
            $sql = $this->connect->prepare("SELECT * FROM  `orders` WHERE user_id= ? AND name= ? AND number= ? AND email= ? AND active=1");
            $sql->execute([$user_id,$name,$number,$email]);
            $row = $sql->rowCount();
            return $row;
        }
        public function selectCheckoutCart($user_id){
            $sql = $this->connect->prepare("SELECT * FROM  `cart` WHERE user_id= ?");
            $sql->execute([$user_id]);
            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
        public function checkoutProceed($user_id,$name,$number,$email,$method,$address,$total_product,$total_price){
            $sql = $this->connect->prepare("INSERT INTO `orders` (user_id,name,number,email,method,address,total_products,total_price)
            VALUES (?,?,?,?,?,?,?,?)");
            $sql->execute([$user_id,$name,$number,$email,$method,$address,$total_product,$total_price]);
            return true;
        }
        // orders control 
        public function countProOrders($user_id){
            $sql = $this->connect->prepare("SELECT * FROM  `orders` WHERE user_id= ? AND active=1");
            $sql->execute([$user_id]);
            $row = $sql->rowCount();
            return $row;
        }
        public function displayProOrders($user_id){
            $sql = $this->connect->prepare("SELECT * FROM  `orders` WHERE user_id= ? AND active=1");
            $sql->execute([$user_id]);
            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
        public function getIDOrders($id){
            $sql = $this->connect->prepare("SELECT * FROM  `orders` WHERE id= ? AND active=1");
            $sql->execute([$id]);
            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }



    }
?>