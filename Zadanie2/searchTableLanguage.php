<?php 
if(count($terms) < 1){
    echo '<h4>This term was not found.</h4>';
}elseif(count($terms) == 1){
    echo '<table>';
    echo    '<thead>';
    echo        '<tr>';
    echo            '<th>Term</th><th>Description</th><th>Translation</th><th>Translation description</th>';
    echo        '</tr>';
    echo    '</thead>';
    echo    '<tbody>';

    foreach($terms as $term){

        if($term['language_id'] == 2){
            $langId = 1;
        }else{
            $langId = 2;
        }

        $sql = 'SELECT * FROM glossary WHERE term_id = ? AND language_id = ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$term['term_id'], $langId]);
        $other = $stmt->fetch(PDO::FETCH_ASSOC);
    

    echo            "<tr><td>{$term['term']}</td><td>{$term['description']}</td><td>{$other['term']}</td><td>{$other['description']}</td></tr>";   
    }     
    echo    '</tbody>';
    echo '</table>';
}else{
    echo '<table>';
    echo    '<thead>';
    echo        '<tr>';
    echo            '<th>Term</th><th>Description</th><th>Translation</th><th>Translation description</th>';
    echo        '</tr>';
    echo    '</thead>';
    echo    '<tbody>';
        
            foreach($terms as $term){

                if($term['language_id'] == 2){
                    $langId = 1;
                }else{
                    $langId = 2;
                }

                $sql = 'SELECT * FROM glossary WHERE term_id = ? AND language_id = ?';
                $stmt = $conn->prepare($sql);
                $stmt->execute([$term['term_id'], $langId]);
                $other = $stmt->fetch(PDO::FETCH_ASSOC);

    echo        '<tr>';
    echo            "<td class='click' onclick='descriptionLanguage(this)'>{$term['term']}</td>";
    echo            "<td class='description'>{$term['description']}</td>";
    echo            "<td class='otherTerm'>{$other['term']}</td>";
    echo            "<td class='otherDescription'>{$other['description']}</td>";
    echo        '</tr>';              
            }
            
    echo    '</tbody>';
    echo '</table>';
}       
?>