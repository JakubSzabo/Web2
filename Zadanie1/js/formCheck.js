function formCheck(event){
    if(document.getElementById('fileName').value == "" || document.getElementById('file').value == ""){
        event.preventDefault();
        error("Something go wrong", "Forgot enter name or file");
        return 0;
    }   
}