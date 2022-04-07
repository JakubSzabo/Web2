function getAll() {
  const table = document.getElementById("tBody");
  if(document.getElementById("getAll").style.display == "inline-block"){
    table.innerHTML = ' ';
    document.getElementById("getAll").style.display = "none";
  }else{
    document.getElementById("getAll").style.display = "inline-block";
    fetch("https://site165.webte.fei.stuba.sk/api/inventors/all")
      .then((response) => response.json())
      .then((data) => {
        data.forEach((element) => {
          const tr = document.createElement("tr");
          table.appendChild(tr);

          const id = document.createElement("td");
          id.innerHTML = element["id"];
          tr.appendChild(id);
          
          const name = document.createElement("td");
          name.innerHTML = element["name"];
          tr.appendChild(name);
          
          const lastName = document.createElement("td");
          lastName.innerHTML = element["last_name"];
          tr.appendChild(lastName);

          const image = document.createElement("td");
          const imageElement = document.createElement("img");
          tr.appendChild(image);
          if(element["img"] != null){
              imageElement.src = "pictures/" + element["img"];
              image.appendChild(imageElement);
          }
          
          const birthPlace = document.createElement("td");
          birthPlace.innerHTML = element["birthplace"];
          tr.appendChild(birthPlace);

          const birth = document.createElement("td");
          birth.innerHTML = element["birth"];
          tr.appendChild(birth);

          const deathPlace = document.createElement("td");
          deathPlace.innerHTML = element["deathplace"];
          tr.appendChild(deathPlace);

          const death = document.createElement("td");
          death.innerHTML = element["death"];
          tr.appendChild(death);

          const invention = document.createElement("td");
          invention.innerHTML = element["invention"];
          tr.appendChild(invention);

          const editDelete = document.createElement("td");
          const buttonEdit = document.createElement("button");
          buttonEdit.innerText = 'Edit';
          buttonEdit.addEventListener("click", getEdit);
          editDelete.appendChild(buttonEdit);
          const buttonDelete = document.createElement("button");
          buttonDelete.innerText = 'Delete';
          buttonDelete.addEventListener("click", deleteInventor);
          editDelete.appendChild(buttonDelete);
          tr.appendChild(editDelete);
        });
      });
  }
}

function getEdit(){
  const id = this.parentElement.parentElement.firstChild.innerHTML;
  console.log(id);
  fetch("https://site165.webte.fei.stuba.sk/api/edit/" + id)
      .then((response) => response.json())
      .then((data) => {
        const background = document.getElementById('background')
        background.style.display = 'block';
        
        
        console.log(data);
      })
}