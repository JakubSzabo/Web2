function deleteInventor(){
    const id = this.parentElement.parentElement.firstChild.innerHTML;
    
    fetch('https://site165.webte.fei.stuba.sk/api/inventors/' + id, {
    method: 'DELETE',
    })
    .then(res => res.text()) // or res.json()
    .then(res => console.log(res))

    const table = document.getElementById("tBody");
    table.innerHTML = ' ';
    document.getElementById("getAll").style.display = "none";
}