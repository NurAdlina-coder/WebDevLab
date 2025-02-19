<!DOCTYPE html>
<html lang="en">
<head>
 <title>Lab 5a Q2</title>
</head>
<body>
    
<?php // VERY IMPPORTANT TO HAVE when doing php
$students['s1'] = array(
    "name" => "Alice",
    "program" => "BIP",
    "age" => 21
);

$students['s2'] = array(
    "name" => "Bob",
    "program" => "BIS",
    "age" => 20
);

$students['s3'] = array(
    "name" => "Raju",
    "program" => "BIT",
    "age" => 22
);

// Each row basic table
//foreach($students as $key => $value) {
 //   echo "Name:" . $value['name'] . ", Program: " . $value['program'] . ", Age: " . $value['age'] . "<br>";
//}

?>

<table>
    <tr>
        <th>Name</th>
        <th>Program</th>
        <th>Age</th>
    </tr>
<?php foreach($students as $value): ?>
    <tr> 
        <td><?php echo $value['name']; ?> </td>
        <td><?php echo $value['program']; ?> </td>
        <td><?php echo $value['age']; ?> </td>
    </tr>
<?php endforeach; ?>
</table>


</body>
</html>