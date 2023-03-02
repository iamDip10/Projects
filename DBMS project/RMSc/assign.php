

<?php
session_start();
// connecting to database
$conn = new mysqli('localhost', 'root', '', 'rms');

$fg = "select payment_status, status from orders where order_id = '".$_GET['oid']."'" ;
$lk = $conn->query($fg) ;
$lo = $lk->fetch_assoc() ;

if ($lo['status'] == "Deliver!" ) {

        $rt = "delete from orders where order_id = '".$_GET['oid']."'" ;
        $gh = $conn->query($rt) ;
        header('location: managerdash.php?id='.$_GET['id'].'&name='.$_GET['name']) ;
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ass.css">
    <title>Document</title>
</head>
<body>

<!-- This container shows the avalability of chiefs -->
<div class="popup" >
                <h2>Available Cheifs</h2>
                <h3 id="h3"></h3>
                <!-- Displaying the list of availabel chief in tabular way -->
                <table >
                    <tr>
                        <th>Name</th>
                        <th>Availability Status</th>
                        <th>Task</th>
                    </tr>

                    <?php
                    // here it is a query that select all the chiefs from the database
                        $chf = "select * from chief where res_id = '".$_GET['id']."'" ;
                        // running the query
                        $hiraa = $conn->query($chf) ;
                        while ($resHira = $hiraa->fetch_assoc()) {?>

                            <tr>
                                <!-- here $resHira is an array as fetch_assoc() resturns an array and index is the row name of table of database -->
                                    <td><?php echo $resHira['name'] ?></td>
                                    <td id="active"><?php echo $resHira['active_status'] ?></td>
                                    <!-- when pressed assign below it will redirect to poassign.php for further backend work -->
                                    <td><a href="poassign.php?id=<?php echo $_GET['oid']?>&mid=<?php echo $_GET['id']?>&name=<?php echo $resHira['name']?>">Assign</a></td>
                                
                            </tr>        

                        <?php
                        }
                    ?>
                
                </table>
</div>


</body>
</html>

