<div id="signup">
    <?php
	    
    
    echo '<div class="table_name">Таблица последних заказов</div>';
    // Выводим результаты в html
    echo "
    <table>
    <tr>
    <td>ID</td>
    <td>User id</td>
    <td>Product id</td>
    <td>Username</td>
    <td>Email</td>
    <td>Phone</td>
    <td>Region</td>
    <td>City</td>
    <td>Address</td>
    <td>Delivery type</td>
    <td>Payment type</td>
    <td>Purchase date</td>
    <td>Order status</td>
    </tr>
    \n";
    $link_c = mysqli_connect('localhost', 'root', '', "onlinestore") or die('Не удалось соединиться: ' . mysqli_error());    
    // Выполняем SQL - запрос
    $query = 'SELECT * FROM purchase_history WHERE order_status=0 ORDER BY purchase_date ASC';
    $result= mysqli_query($link_c, $query) or die('Запрос не удался: ' . mysqli_error());
        
    while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo "<tr>\n";
        foreach ($line as $col_value) {
            echo "<td>$col_value</td>\n";
        }
        echo "</tr>\n";
    }
    echo "
    </table>\n";
    mysqli_free_result($result); 	// Освобождаем память от результата
	mysqli_close($link_c);            // Закрываем соединение
    ?>
</div>