<?php
require 'conn.php';

if (isset($_POST['btnSend']) && $_POST['btnSend'] === 'send') {
    $message = mysqli_real_escape_string($conn, $_POST['userMessage']);
    $send_message = "INSERT INTO `23bca699`.`chat` (messages) VALUES ('$message')";
    mysqli_query($conn, $send_message);
    mysqli_query($conn, "DELETE FROM `23bca699`.`chat` WHERE id NOT IN (SELECT id FROM (SELECT id FROM `23bca699`.`chat` ORDER BY id DESC LIMIT 30) AS temp)");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Simple Chat</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<script>
    // function loadMessages() {
    //     var xhr = new XMLHttpRequest();
    //     xhr.open("GET", "load_message.php", true);
    //     xhr.onload = function () {
    //         if (this.status == 200) {
    //             document.getElementById("messages").innerHTML = this.responseText;
    //         }
    //     };
    //     xhr.send();
    // }

    function loadMessages() {
        var msgBox = document.getElementById("messages");
        var isAtBottom = (msgBox.scrollHeight - msgBox.scrollTop <= msgBox.clientHeight + 50);

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "load_message.php", true);
        xhr.onload = function () {
            if (this.status == 200) {
                msgBox.innerHTML = this.responseText;

                if (isAtBottom) {
                    msgBox.scrollTop = msgBox.scrollHeight;
                }
            }
        };
        xhr.send();
    }

    setInterval(loadMessages, 2000);
    window.onload = loadMessages;
</script>


<body>

    <div class="outer-div">
        <div class="msg-box" id="messages">

        </div>
    </div>
    <form method="post" class="chat-form">
        <input type="text" name="userMessage" class="form-control message-input" placeholder="Type a message...">
        <button type="submit" name="btnSend" value="send" class="btn btn-rounded send-btn"><img src="send.png" style="height: 30px;" alt="Send"></button>
    </form>
</body>

</html>