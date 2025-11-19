<?php
    echo "<div class='column'>";
    if(isset($_POST['unidades'])){
        echo $_POST['producto']."</br>";
        echo $_POST['unidades']."</br>";
    }else{
        echo "No hay productos seleccionados";
    }
    echo"</div>";
?>