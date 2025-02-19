<!DOCTYPE html>
<html lang="en">
<head>
 <title>Lab 5a Q1</title>
</head>
<body>
 <?php $name = "Nur Alya Adlina binti Mohamad Lazi";?>
 <?php $matric = "AI220381";?>
 <?php $course = "BIM";?>
 <?php $year = "3";?>
 <?php $address = "118, Jalan Haji, Kampung Pengkalan Batu, Mersing 86800 Johor";?>

 <table>
    <tr>
        <td>Name</td>
        <td><?php echo "$name"; ?></td> 
    </tr>
    <tr>
        <td>Matric Number</td>
        <td><?php echo "$matric"; ?></td>
    </tr>
    <tr>
        <td>Course</td>
        <td><?php echo "$course"; ?></td>
    </tr>
    <tr>
        <td>Year of Study</td>
        <td><?php echo "$year"; ?></td>
    </tr>
    <tr>
        <td>Address</td>
        <td><?php echo "$address"; ?></td>
    </tr>
 </table>
 
</body>
</html>