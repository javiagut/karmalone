$(document).ready(function () {

    var confirm = document.getElementById('password-confirm');
    var password = document.getElementById('password');

    confirm.addEventListener('keyup',comprobar);
    password.addEventListener("keyup", comprobar);

    function comprobar(){
        var confirm = document.getElementById('password-confirm').value;
        var password = document.getElementById('password').value;
        var error = document.getElementById('contras');
        var btn = document.getElementById('submitCrearUser');
        console.log(confirm!=password);
        if(confirm!=password){
            error.style.display = 'flex';
            btn.setAttribute('disabled','true');
        }
        else{
            error.style.display = 'none';
            btn.removeAttribute('disabled');
        }
    }

});