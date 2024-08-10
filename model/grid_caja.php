<?php
include("config.php");

$sql_caja_grid="select * from caja ";

$result_caja_grid=mysqli_query($_CNX, $sql_caja_grid);

while($fila_caja_grid=mysqli_fetch_array($result_caja_grid)){
    echo "<tr>";
        echo "<td>$fila_caja_grid[0]</td>";
        echo "<td>$fila_caja_grid[1]</td>";
        echo "<td>$fila_caja_grid[2]</td>";
        echo "<td>$fila_caja_grid[3]</td>";
        echo "<td>$fila_caja_grid[4]</td>";
        echo "<td>$fila_caja_grid[5]</td>";
        echo "<td>$fila_caja_grid[6]</td>";
        echo "<td><span class='badge badge-pill'
                    data-bgcolor='#e7ebf5'
                    data-color='#265ed7'
                    >$fila_caja_grid[7]</span></td>";
        echo "<td>";
        
        echo '<div class="table-actions">
                    <a href="#" data-color="#265ed7"
                        ><i class="icon-copy dw dw-edit2"></i
                    ></a>
                    <a href="#" data-color="#e95959"
                        ><i class="icon-copy dw dw-delete-3"></i
                    ></a>
                </div>';
        echo "</td>";
    echo "</tr>";
}

?>