var slideIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > x.length) {slideIndex = 1}
  x[slideIndex-1].style.display = "block";
  setTimeout(carousel, 2000); // Change image every 2 seconds
}

document.addEventListener("DOMContentLoaded", function() {
  // Função para obter o valor de um cookie pelo nome
  function getCookie(Nome) {
    let nameEQ = Nome + "=";
    let ca = document.cookie.split(';');
    for(let i=0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') c = c.substring(1,c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
  }

  var username = getCookie('username');
  if (username !== null && username !== "") {
      var Nome = username.split('%20')[0]; // Pega o primeiro nome do usuário
      var mensagemWelcome = document.getElementById("mensagemWelcome");
      if (mensagemWelcome) {
          mensagemWelcome.textContent = 'Bem-vindo, ' + firstName;
          mensagemWelcome.style.display = 'inline-block';
      }
  }
});
