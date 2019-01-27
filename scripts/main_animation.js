window.onload = function(){ 
    var element = document.getElementById("animate");
    var logo = document.querySelector("header a img");
    var pos = 50;
    const width = 600;
    const milisec = 20;
    var ofset = width/(3000/milisec);
    var seconds_id;
    
    element.onclick = function(){
      seconds_id = setInterval(animate, milisec);  
    };
    
    function animate(){
        pos+=ofset;
        logo.style.left = pos+"px";
        
        if(pos >= 650){
            clearInterval(seconds_id);
            logo.style.left = 50 + "px";
        }
    }
}

