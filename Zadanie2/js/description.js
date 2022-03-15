function description(element){
    const descriptions = document.getElementsByClassName('description');
    //console.log(descriptions)
    for (const des of descriptions){
        des.style.visibility = 'hidden';
    }
    const td = element.nextElementSibling;
    td.style.visibility = 'visible';
}   