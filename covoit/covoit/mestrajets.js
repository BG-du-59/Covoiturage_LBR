

function fonction(){
    etat = document.getElementById("destinationbis").style.display
    if(etat=="none"){
        document.getElementById("destination2").style.display = "none";
        document.getElementById("destination").style.display = "none";
        document.getElementById("destination2bis").style.display = "block";
        document.getElementById("destinationbis").style.display = "block";
        return;
    }
    else{
        document.getElementById("destination2").style.display = "block";
        document.getElementById("destination").style.display = "block";
        document.getElementById("destination2bis").style.display = "none";
        document.getElementById("destinationbis").style.display = "none";
        return;

    }
    
}

function changement_fenetre(){
    etat = document.getElementById("fenetre2").style.display
    if(etat=="none"){
        document.getElementById("fenetre1").style.display = "none";
        document.getElementById("fenetre2").style.display = "block";
        
        return;
    }
    else{
        document.getElementById("fenetre1").style.display = "block";
        document.getElementById("fenetre2").style.display = "none";
        return;
    }
}



	
