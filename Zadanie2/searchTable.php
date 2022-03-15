<?php 
if(count($terms) < 1){
    echo '<h4>This term was not found.</hs>';
}elseif(count($terms) == 1){
    echo '<table>';
    echo    '<thead>';
    echo        '<tr>';
    echo            '<th>Term</th><th>Description</th>';
    echo        '</tr>';
    echo    '</thead>';
    echo    '<tbody>';
    echo            "<tr><td>{$terms[0]['term']}</td><td>{$terms[0]['description']}</td></tr>";        
    echo    '</tbody>';
    echo '</table>';
}else{
    echo '<table>';
    echo    '<thead>';
    echo        '<tr>';
    echo            '<th>Term</th><th>Description</th>';
    echo        '</tr>';
    echo    '</thead>';
    echo    '<tbody>';
        
            foreach($terms as $term){
    echo        "<tr><td class='click' onclick='description(this)'>{$term['term']}</td><td class='description'>{$term['description']}</td></tr>";              
            }
            
    echo    '</tbody>';
    echo '</table>';
}       
?>