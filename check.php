<?php
// $geeks= "alert(\"Hello\")";
// echo htmlspecialchars($geeks);
// $newgeeks = filter_var($geeks, FILTER_SANITIZE_STRING);
// echo $newgeeks;

$title = filter_var("alert(\"hello\")",FILTER_UNSAFE_RAW);
echo $title;