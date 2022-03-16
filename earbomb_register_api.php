<?php //require __DIR__."/__connect__db.php"; ?>
<?php require __DIR__."/__connect__db.php";

$result = array(
        'success' => false,
        'error' => '沒有給參數',

);
if(! empty($_POST['email']) and ! empty($_POST['pass']) and ! empty($_POST['nickname'])) {

    $pass = sha1($_POST['pass']);
    $hash = md5($_POST['email']. uniqid() );

    $sql = "INSERT INTO `members`(
            `email`, `name`, `password`, 
            `mobile`, `twitter`, `facebook`, 
            `address`, `birthday`, `hash`, 
            `activated`, `nickname`, `create_at`) 
            VALUES (
            ?,?,?,
            ?,?,?,
            ?,?,?,
            0,?,NOW())
            ";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ssssssssss',
        $_POST['email'],
        $_POST['name'],
        $pass,
        $_POST['mobile'],
        $_POST['twitter'],
        $_POST['facebook'],
        $_POST['address'],
        $_POST['birthday'],
        $hash,
        $_POST['nickname']
        );

    $stmt->execute();

    if($stmt->affected_rows==1){
        $result = array(
            'success' => true,
            'error' => '',

        );
    } elseif($stmt->affected_rows==-1) {
        $result['error'] = 'email重複使用';
    } else {
        $result['error'] = '發生錯誤';
    }



}
echo json_encode($result, JSON_UNESCAPED_UNICODE);

?>


