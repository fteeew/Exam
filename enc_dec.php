<!DOCTYPE html>
<html>
<body>

<?php
$str = "aya";
// Encode the string
$encodeString = convert_uuencode($str);
$r=sha1($str);
echo $r;
$e=sha1($r);
echo $e;
//cho $encodeString . "<br>";

// Decode the string
$decodeString = convert_uudecode($encodeString);
echo $decodeString;
?> 

</body>
</html>