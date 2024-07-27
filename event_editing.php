<?php
    $title = "Edit an Event";
    include('dependencies/header.php');
?>

<style>
    <?php include('css/event_editing.css');?>
    <?php include('css/header.css');?>
    <?php include('css/footer.css');?>
</style>

<!-- content -->
<?php if (isset($_SESSION['isadmin']) && $_SESSION['isadmin'] == 1) { ?>
    <div class="container">
        <h2>Events Record</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Program</th>
                <th>Actions</th>
            </tr>

        <?php
        $studQuery = mysqli_query($conn, "SELECT * FROM tblstudent ORDER BY name");
        while ($studResult = mysqli_fetch_assoc($studQuery)){
            echo "<tr>";
            echo "<td>". $studResult["id"]. "</td>";
            echo "<td>". $studResult["name"]. "</td>";
            echo "<td>". $studResult["gender"]. "</td>";
            echo "<td>". $studResult["program"]. "</td>";
            echo "<td>
                    <form method='POST' action='' style='display:inline-block;'>
                        <input type='hidden' name='delete_id' value='". $studResult["id"]. "'>
                        <input type='submit' value='Delete'>
                    </form>

                    <form method='GET' action='update_akia.php' style='display:inline-block;'>
                        <input type='hidden' name='id' value='". $studResult["id"]. "'>
                        <input type='submit' value='Edit'>
                    </form>
                </td>";
            echo "</tr>";
        }
        ?>

        </table>
    </div>
<?php } ?>
<!-- end of content -->

<?php
    include('dependencies/footer.php');
?>