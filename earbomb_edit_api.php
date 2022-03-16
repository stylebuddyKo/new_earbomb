<?php //require __DIR__."/__connect__db.php"; ?>
<?php require __DIR__."/__connect__db.php";

if(!isset($_SESSION['user'])){
    echo json_encode(array(
        'success' => false,
        'error' => '沒有登入',
    ));
    exit;
}

$result = array(
        'success' => false,
        'error' => '沒有給參數',
        'post' => $_POST,

);
if(!empty($_POST['pass']) and !empty($_POST['nickname'])) {

    $pass = sha1($_POST['pass']);

    $sql = "UPDATE `members` 
            SET `name`=?,
                `mobile`=?,
                `twitter`=?,
                `facebook`=?,
                `address`=?,
                `birthday`=?,
                `nickname`=? 
            WHERE `id`=? AND `password`=?";
    $stmt = $mysqli->prepare($sql);
    echo $mysqli->error;
    $stmt->bind_param('sssssssis',
        $_POST['name'],
        $_POST['mobile'],
        $_POST['twitter'],
        $_POST['facebook'],
        $_POST['address'],
        $_POST['birthday'],
        $_POST['nickname'],
        $_SESSION['user']['id'],
        $pass
        );

    $stmt->execute();

    if($stmt->affected_rows==1){
        $_SESSION['user']['name'] = $_POST['name'];
        $_SESSION['user']['mobile'] = $_POST['mobile'];
        $_SESSION['user']['twitter'] = $_POST['twitter'];
        $_SESSION['user']['facebook'] = $_POST['facebook'];
        $_SESSION['user']['address'] = $_POST['address'];
        $_SESSION['user']['birthday'] = $_POST['birthday'];
        $_SESSION['user']['nickname'] = $_POST['nickname'];

        $result['success'] = true ;

    } else {
        $result['error'] = '密碼錯誤或資料未變更';
    }



}
echo json_encode($result, JSON_UNESCAPED_UNICODE);

?>


