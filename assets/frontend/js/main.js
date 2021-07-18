


// Get the modal
var modal = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function fixText()
{
        if(document.querySelector("#myNavbar").className=="navbar-collapse collapse in")
        { 
            document.querySelector("body > div.bg-text").style.transform="translate(-50%, -50%)"
        }        
    else
        {
            document.querySelector("body > div.bg-text").style.transform="translate(-50%, 50%)"

        }
}