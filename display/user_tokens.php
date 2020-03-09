<?php
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Voleur</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Oswald&display=swap');
        *{
            margin: 0;
            padding: 0;
        }
        #page{
            background: url(../display/clouds-2329680_1920.jpg) no-repeat center top / cover;
            min-height:100vh;
            overflow: hidden;

        }


        #block_uuid{
            position: absolute;
            top: 25%;
            left: 22.5%;
            font-size: 20q;
            width: 550px;
            height: 450px;
            background-color: floralwhite;
            opacity: 75%;
            border: 5px inset deepskyblue;
            color: black;
            padding: 10px;
            border-radius: 50px;
        }
        p{
            font-family:'Oswald', sans-serif;
        }
        #guide_text{
            position: absolute;
            bottom: 10%;
            opacity: 100;
            color: mediumvioletred;
            border-radius: 10px;
        }
        .uuid_code{
            margin-top: 20px;
            color: black;
            font-style: inherit;
            border-radius: 10px;
        }
    </style>
</head>
<body>
<div id="page">
    <form name="form_create_uuid" id="uuid_create_form" class="form">
        <div id="block_uuid">
            <div id="admin_uuid" class="uuid_code"><p>ADMIN ID: <?php echo $keys['admin_key']?></p></div><br>
            <div id="user_uuid" class="uuid_code"><p>USER ID: <?php echo $keys['user_key']?></p></div>
            <div id="guide_text"><p>Return to chrome extension and enter one of twice key.<br>
                    If you enter user key - opened donation table.<br>
                    If enter admin key - in main window additional button
                    REFRESH UUID, which refresh your id (admin and user)
                    and button DONATION TABLE, which redirect you to donation list </p>
            </div>
        </div>

    </form>
</div>
</body>
</html>
