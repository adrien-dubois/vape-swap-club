// CAROUSEL
$(document).ready(function() {
    $('#autoWidth').lightSlider({
        autoWidth:true,
        loop:true,
        onSliderLoad: function() {
            $('#autoWidth').removeClass('cS-hidden');
        } 
    });  
});

// Toggle personnal menu

function menuToggle(){
    const toggleMenu = document.querySelector('.menu-dropdown');
    toggleMenu.classList.toggle('active')
}
  

//LOGIN SECTION - MODAL


document.getElementById('button').addEventListener('click', function(){
    document.querySelector('.bg-modal').style.display = 'flex';
});

document.querySelector('.close').addEventListener('click', function(){
    document.querySelector('.bg-modal').style.display = 'none';
});


// LOGIN FORM

const form = document.getElementById('form');
form.addEventListener('submit', event => {
    event.preventDefault();
    const url = form.action;
    const formData = new FormData(form);
    fetch(url, {
        method: 'POST',
        body: formData
    }).then(data => {
        return data.json()
    }).then(json => {
        if(json.formIsValid) {
            window.location = json.Location
        } else {
            const errors = document.getElementById('errors');
            errors.innerHTML = null
            for (error of json.errorList) {
                let p = document.createElement("p")
                p.innerHTML = error
                p.classList.add('error')
                errors.append(p)
            }
            form.password.value = null

        }
    })
})

// Put all forms autocompletion off

$(document).ready(function(){
    $('form').attr('autocomplete', 'off');
});

