<table>
    <thead>
        <tr>
            <th>ID</th><th>Name</th><th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        
        if(count($terms) > 0){
            foreach($terms as $term){
                echo "<tr><td>{$term['id']}</td><td>{$term['name']}</td><td><a href='edit.php?id={$term['id']}'>Edit</a></td></tr>";        
            }
        }

        ?>
    </tbody>
</table>