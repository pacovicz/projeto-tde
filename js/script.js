function cadastrar(event, form) {
  event.preventDefault();
  const erroContainer = document.querySelector('.error');
  const sucessoContainer = document.querySelector('.success');
  erroContainer.innerHTML = '';
  erroContainer.classList.add('hidden');
  sucessoContainer.innerHTML = '';
  sucessoContainer.classList.add('hidden');

  const formData = new URLSearchParams(new FormData(form));
  fetch('../php/criarUsuario.php', {
    method: "POST",
    body: formData
  })
    .then(res => res.json())
    .then(data => {
      if (data.erro) {
        erroContainer.innerHTML = data.mensagem;
        erroContainer.classList.remove('hidden');
        return;
      }

      sucessoContainer.innerHTML = 'Usuário cadastrado com sucesso!';
      sucessoContainer.classList.remove('hidden');
    });
}