function arrowActivation(element){
    if(element.nextElementSibling){
        element.nextElementSibling.children[1].id = "";
        element.nextElementSibling.children[0].id = "";
        if(element.nextElementSibling.nextElementSibling){
            element.nextElementSibling.nextElementSibling.children[1].id = "";
            element.nextElementSibling.nextElementSibling.children[0].id = "";
        }
        else if(element.nextElementSibling && element.previousElementSibling){
            element.previousElementSibling.children[0].id = "";
            element.previousElementSibling.children[1].id = "";
        }
    }
    else if(element.previousElementSibling.previousElementSibling){
        element.previousElementSibling.children[1].id = "";
        element.previousElementSibling.children[0].id = "";
        element.previousElementSibling.previousElementSibling.children[1].id = "";
        element.previousElementSibling.previousElementSibling.children[0].id = "";
    }
}

function sortBy(by, from){
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("myTable");

    switching = true;
    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[by];
            y = rows[i + 1].getElementsByTagName("TD")[by];
            if(by == '0' && from == 'up'){
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                } 
            }
            else if((by == '1' || by == '2') && from == 'up'){
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                } 
            }
            else if((by == '1' || by == '2') && from == 'down'){
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                } 
            }
            else if(by == '0' && from == 'down'){
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }  
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}

function sort(element){

    if(element.children[0].id == "active"){
        element.children[0].id = "";
        element.children[1].id = "active";   
        
        arrowActivation(element);
    }
    else if(element.children[1].id == "active"){
        element.children[1].id = "";
        element.children[0].id = "active"; 

        arrowActivation(element);
    }
    else{
        element.children[0].id = "active";

        arrowActivation(element);
    }

    const activeFilter = document.getElementById("active").parentElement.getAttribute('filterType');
    var by;
    if(activeFilter == 'name') by = '0';
    else if(activeFilter == 'size') by = '1';
    else if(activeFilter == 'date') by = '2'; 

    const filterOrder = document.getElementById("active").className
    
    if(filterOrder == "fas fa-arrow-up"){
        var from = 'up';
    }else{
        from = 'down';
    }

    sortBy(by, from);
}