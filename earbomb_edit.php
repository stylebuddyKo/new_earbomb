<?php //require __DIR__."/__connect__db.php";
//$title = '會員註冊';
//$page_name= 'data_insert';
//
//if(isset($_POST['name'])) {
//
//$sql = "INSERT INTO `members`
//                  (
//                  `email`, `name`, `password`, `mobile`, `twitter`, `facebook`,
//                   `address`, `birthday`,`nickname`
//                  ) VALUES (
//                  ?,?,?,?,?,?,
//                  ?,?,?
//                  )";
//$stmt = $mysqli->prepare($sql);
//
//$stmt->bind_param('sssssssss',
//    $_POST['email'],
//    $_POST['name'],
//    $_POST['pass'],
//    $_POST['mobile'],
//    $_POST['twitter'],
//    $_POST['facebook'],
//    $_POST['address'],
//    $_POST['birthday'],
//    $_POST['nickname']
//
//);
//
//$stmt->execute();
//
//$affected_rows= $stmt->affected_rows;
//?>
<?php require __DIR__."/__connect__db.php";
$title = '資料編輯';
$page_name= 'data_edit';

if(! isset($_SESSION['user'])){
    header("Location: ./earbomb_index.php");
    exit;
}

?>
<?php include __DIR__."/earbomb_html_head.php"; ?>
<style>
    #my-alert{
        display: none;
    }
</style>


<div class="register-container">
    <?php include __DIR__."/earbomb_navbar.php"; ?>

        <div id="my-alert" class="alert alert-success" role="alert">

        </div>

    <form action="" name="form1" method="post" onsubmit="return checkForm()" id="msform">
        <!-- progressbar -->
        <ul id="progressbar">
            <li class="active">Account Setup</li>
            <li>Social Profiles</li>
            <li>Personal Details</li>
        </ul>
        <!-- fieldsets -->
        <fieldset>
            <h2 class="fs-title">修改會員資料</h2>
            <h3 class="fs-subtitle">This is step 1</h3>
            <input type="email" name="email" id="email" placeholder="Email" value="<?= $_SESSION['user']['email'] ?>" disabled/>
            <small id="emailHlep" class="form-text text-muted">請填入電郵</small>
            <input type="password" name="pass" placeholder="Password Check" />
            <input type="text" name="nickname" placeholder="Nickname" value="<?= $_SESSION['user']['nickname'] ?>">
            <input type="button" name="next" class="next action-button" value="Next"/>
        </fieldset>
        <fieldset>
            <h2 class="fs-title">Social Profiles</h2>
            <h3 class="fs-subtitle">Your presence on the social network</h3>
            <input type="text" name="twitter" placeholder="Twitter" value="<?= $_SESSION['user']['twitter'] ?>" />
            <input type="text" name="facebook" placeholder="Facebook" value="<?= $_SESSION['user']['facebook'] ?>" />
            <input type="button" name="previous" class="previous action-button" value="Previous" />
            <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>
        <fieldset>
            <h2 class="fs-title">Personal Details</h2>
            <h3 class="fs-subtitle">We will never sell it</h3>
            <input type="text" name="name" id="name" placeholder="Name" value="<?= $_SESSION['user']['name'] ?>" />
            <small id="nameHlep" class="form-text text-muted">請填入姓名</small>
            <input type="text" name="mobile" id="mobile" placeholder="Mobile" value="<?= $_SESSION['user']['mobile'] ?>"/>
            <small id="mobileHlep" class="form-text text-muted">請填入手機</small>
            <input type="text" name="birthday" id="birthday" placeholder="Birthday" value="<?= $_SESSION['user']['birthday'] ?>"/>
            <small id="birthdayHlep" class="form-text text-muted">請填入生日</small>
            <textarea name="address" id="address" placeholder="Address" value=""><?= $_SESSION['user']['address'] ?></textarea>
            <small id="addressHlep" class="form-text text-muted">請填入地址</small>
            <input type="button" name="previous" class="previous action-button" value="Previous" />
            <input type="submit" name="submit" class="submit action-button" value="Submit" />
        </fieldset>
    </form>


</div>

<script>
    var field_names = ['name', 'mobile', 'email','birthday','address'];
    var fields = {};
    var i, s, key;
    var pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    var mobile_pattern = /[0-9\-]{10,}/;

    for(i=0;i<field_names.length;i++){
        key = field_names[i];
        fields[key] = {
            input: $('#'+key),
            help: $('#'+key+'Help')
        };
    }
    console.log(fields);

    var my_alert = $('#my-alert');
    var btn = $('form .submit');

    function checkForm(){

        var isPass = true;

        for(s in fields){
            fields[s].help.hide();
            fields[s].input.css('border-color','#ccc');
//            isPass = false;
        }


        if(fields['name'].input.val().length<2){
//            alert('請填入姓名');
            fields['name'].help.show();
            fields['name'].input.css('border-color','red');
            isPass = false;
        }

        if(! mobile_pattern.test(fields['mobile'].input.val() )){
//            alert('請填入姓名');
            fields['mobile'].help.show();
            fields['mobile'].input.css('border-color','red');
            isPass = false;
        }

        if(isPass){
            btn.hide();

            $.post('earbomb_edit_api.php', $(document.form1).serialize(), function(data){
                console.log(data);
                my_alert.show();
                if(data.success){
                    my_alert.attr('class','alert alert-success');
                    my_alert.html("修改完成");
                    setTimeout(function(){
                        location.href = "./earbomb_index.php"
                    }, 2000);
                } else {
                    my_alert.attr('class','alert alert-danger');
                    btn.show();
                    my_alert.html(data.error);
                }

            }, 'json');
        }

        return false;
    }
    //jQuery time
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches

    $(".next").click(function(){
        if(animating) return false;
        animating = true;

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //activate next step on progressbar using the index of next_fs
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
                //2. bring next_fs from the right(50%)
                left = (now * 50)+"%";
                //3. increase opacity of next_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({
                    'transform': 'scale('+scale+')',
                    'position': 'absolute'
                });
                next_fs.css({'left': left, 'opacity': opacity});
            },
            duration: 800,
            complete: function(){
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });

    $(".previous").click(function(){
        if(animating) return false;
        animating = true;

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //de-activate current step on progressbar
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale previous_fs from 80% to 100%
                scale = 0.8 + (1 - now) * 0.2;
                //2. take current_fs to the right(50%) - from 0%
                left = ((1-now) * 50)+"%";
                //3. increase opacity of previous_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({'left': left});
                previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
            },
            duration: 800,
            complete: function(){
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });

    $(".submit").click(function(){

    })
</script>





<?php include __DIR__."/earbomb_html_foot.php"; ?>
