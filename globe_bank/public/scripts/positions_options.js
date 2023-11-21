function setPositions(id, positions){

    const selector = document.getElementById("position");
    
    if (selector.parentNode) {
        for(let child in selector){
            selector.remove(child);
        };
    };

    let count = 0;

    for(let i = 0; i < positions.length; i++){
        if(id == positions[i].id){
            count = positions[i].count;
            break;
        }
    }

    for(let i = 0; i < count; i++){
        const option = document.createElement("option");
        option.value = i + 1;
        option.innerText = i + 1;
        
        selector.append(option);
    };

}

document.getElementById("subject").addEventListener("change",(e)=>{
    setPositions(e.target.value, positions);
});