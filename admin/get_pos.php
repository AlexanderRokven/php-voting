<?php
//Include database connection
require("../config/db.php");
?>
<html>


<?php

global $db; 
$org = trim($_POST['org']);
$sql = "SELECT * FROM position WHERE org = '$org'";
var_dump($org);
if(!$stmt = $db->prepare($sql)) {
    echo $stmt->error;
} else {
    $result = $db->query($sql);
}
?>

<option value="">*****Select Positions*****</option>
<?php if($result) { ?>
    <?php while($rowPos = $result->fetchArray()) { ?>
        <option value="<?php echo $rowPos['pos']; ?>"><?php echo $rowPos['pos']; ?></option>
    <?php } //End while ?>
<?php }//End if 

echo "<p> Hello </p>"; ?>

</html>