function description(element){
    const descriptions = document.getElementsByClassName('description');
    //console.log(descriptions)
    for (const des of descriptions){
        des.style.visibility = 'hidden';
    }
    const td = element.nextElementSibling;
    td.style.visibility = 'visible';
}   

function descriptionLanguage(element){
    const descriptions = document.getElementsByClassName('description');
    const otherTerm = document.getElementsByClassName('otherTerm');
    const otherDescription = document.getElementsByClassName('otherDescription');

    //console.log(descriptions)
    for (const flag of descriptions){
        flag.style.visibility = 'hidden';
    }
    for (const flag of otherTerm){
        flag.style.visibility = 'hidden';
    }
    for (const flag of otherDescription){
        flag.style.visibility = 'hidden';
    }
    let td = element.nextElementSibling;
    td.style.visibility = 'visible';
    td = element.nextElementSibling.nextElementSibling;
    td.style.visibility = 'visible';
    td = element.nextElementSibling.nextElementSibling.nextElementSibling;
    td.style.visibility = 'visible';
}  