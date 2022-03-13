function formCheck(event){
    if(document.getElementById('csv').value == "") {
        event.preventDefault();
        error("Something go wrong", "Forgot enter a file");
        return 0;
    }   
}