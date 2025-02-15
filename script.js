document
  .getElementById("leadForm")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    let formData = new FormData(this);

    fetch("salvar.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        if (data.mensagem !== "Cadastro realizado com sucesso!") {
          alert(data.mensagem);
          return;
        }
        localStorage.setItem("registro", "registrado");
        closeModal(); // Fecha o modal após envio
      })
      .catch((error) => {
        alert("Erro ao enviar o formulário:", error);
      });
  });

function openModal() {
  // Verifica se há informações no localStorage
  let registro = localStorage.getItem("registro");
  if (registro) {
    closeModal();
  } else {
    document.getElementById("formModal").style.display = "flex";
    document.getElementById("main").classList.add("blur");
    document.getElementById("header").classList.add("blur");
  }
}

// Função para fechar o modal
function closeModal() {
  document.getElementById("formModal").style.display = "none";
  document.getElementById("main").classList.remove("blur");
  document.getElementById("header").classList.remove("blur");
  // document.getElementsByClassName("header").classList.remove("blur");
}

window.onload = openModal;
