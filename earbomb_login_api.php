<?php //require __DIR__."/__connect__db.php"; ?>
<?php require __DIR__."/__connect__db.php";

$result = array(
        'success' => false,
);
if(!empty($_POST['email']) and !empty($_POST['pass'])) {

    $pass = sha1($_POST['pass']);

    $sql = sprintf("SELECT `id`, `email`, `mobile`, `address`,
                                  `birthday`, `nickname`,`name`,`twitter`,`facebook`
                          FROM `members` WHERE `email`='%s' AND `password`='%s'",

            $mysqli->escape_string($_POST['email']),
            $pass
        );

    $rs = $mysqli->query($sql);
    if($rs->num_rows){
        $row = $rs->fetch_assoc();
//        unset($row['password']);


        $result['success'] = true;
        $result['data'] = $row;//如果要傳到前端

        $_SESSION['user'] = $row;

    }





}
echo json_encode($result, JSON_UNESCAPED_UNICODE);

?>


