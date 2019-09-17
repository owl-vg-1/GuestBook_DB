<div class="container-fluid w-75">
<div class="d-flex justify-content-center">
<table class="table table-striped table-dark">
<?php 


foreach ($data as $id => $row) {
    echo "<tr>";
    foreach ($row as $value) {
        echo "<td class='text-center'>$value</td>";
    }
    echo "<td><a href='$delURL$id'>$id</a></td></tr>";
}

?>
</table>
</div>
</div>
