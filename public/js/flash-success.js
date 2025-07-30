document.addEventListener('DOMContentLoaded', function(){
    //get the first flash message in the class that appears
    const flash = document.getElementsByClassName('flash-success')[0]; 

    
    if(!flash){
        return;
    }

    //After 3 second, fade out over 500ms then remove the message
    setTimeout(() =>{
        flash.style.transition = 'opacity 0.5s';
        flash.style.opacity = 0;
        setTimeout(() => flash.remove(), 500);
    }, 3000);
});