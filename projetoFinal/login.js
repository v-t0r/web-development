async function sendForm(form) {

    try {
      const response = await fetch("logaCliente.php", { method: 'post', body: new FormData(form) });
      if (!response.ok) throw new Error(response.statusText);
      var bodyText = await response.text();
      const result = JSON.parse(bodyText);

      if (result.success)
        window.location = result.detail;
      else {
        document.querySelector("#loginFailMsg").style.display = 'block';
        form.input_senha.value = "";
        form.input_senha.focus();
      }
    }
    catch (e) {
      console.log(bodyText ?? "");
      console.error(e);
    }
  }

window.onload = function () {
    const form = document.forms.formLogin;
    form.onsubmit = function (e) {
      sendForm(form);
      e.preventDefault();
    }
  }