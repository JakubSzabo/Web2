function deleteErrorLog(){
    var backDrop = document.getElementById('backDrop')
    var child = backDrop.lastElementChild

    while(child){
        backDrop.removeChild(child);
        child = backDrop.lastElementChild;
    }
    document.getElementById('main').removeChild(document.getElementById('main').lastElementChild)
}

function error(title, text){

    const div = document.createElement('div');
    div.id = "backDrop";
    document.getElementById("main").appendChild(div);
    const errorLog = document.createElement('div');
    div.appendChild(errorLog);
    const h3 = document.createElement('h3');
    h3.innerHTML = title;
    const p = document.createElement('p');
    p.innerHTML = text;
    const button = document.createElement('button');
    button.innerHTML = 'Close';
    button.addEventListener("click", deleteErrorLog)
    errorLog.appendChild(h3);
    errorLog.appendChild(p);
    errorLog.appendChild(button);


    
    
}