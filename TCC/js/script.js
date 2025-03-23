const tabUsuario = document.getElementById('tab-usuario');
const tabAdmin = document.getElementById('tab-admin');

tabUsuario.addEventListener('click', () => {
    tabUsuario.classList.add('active');
    tabAdmin.classList.remove('active');
    // Aqui fica na mesma página
});

tabAdmin.addEventListener('click', () => {
    window.location.href = "cadastroadm.php"; // redireciona para admin.php
});