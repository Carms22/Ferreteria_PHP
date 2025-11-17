<?php
    echo "Mantenimiento,Función no disponible.";
    //una para categorias otra para ususarios y otra para productos
    //llamar a sus métodos según clases
    /*
    public function listData(){
        $categories = $this->getData();
        echo "<table>
                <thead>
                    <tr>
                        <th>CodCad</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
            ";

            foreach ($categories as $category) {
                echo "<form method='post' action=''>";
                echo "<tr>";
                echo "<td>" . $category->getCodCat() . "</td>";
                echo "<td>" . $category->getNombre() . "</td>";
                echo "<td>" . $category->getDescripcion() . "</td>";
                echo "<td>
                        <input type='hidden' name='cod' value='{$category->getCodCat()}'>
                        <input type='hidden' name='name' value='{$category->getNombre()}'>
                        <input type='hidden' name='desc' value='{$category->getDescripcion()}'>
                        <button type='submit' name='delete'>Delete</button>
                    </td>";
                echo "<td>
                        <input type='hidden' name='nombre' value='{$category->getNombre()}' placeholder='Introduce nuevo nombre'>
                        <input name='desc' value='{$category->getDescripcion()}' placeholder='Introduce nueva descripción'>
                        <button type='submit' name='update'>Update</button>
                    </td>";
                echo "</tr>";
                echo "</form>";

            }
        
        echo "</tbody></table>";
    }
    */
?>