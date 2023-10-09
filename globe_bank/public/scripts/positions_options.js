function setPositions(index, positions){

    const selector = document.getElementById("position");

    if (selector.parentNode) {
        for(let child in selector){
            selector.remove(child);
        };
    };

    for(let i = 0; i < positions[index]; i++){
        const option = document.createElement("option");
        option.value = i + 1;
        option.innerText = i + 1;
        selector.append(option);
    };

}

document.getElementById("subject").addEventListener("change",(e)=>{
  setPositions(e.target.value, positions);
});