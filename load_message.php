<?php
require 'conn.php';
$res = mysqli_query($conn, "SELECT * FROM `23bca699`.`chat`");

while ($row = $res->fetch_assoc()) { ?>
    <p class="message"><?php echo $row['messages']; ?></p>
<?php } 

?>