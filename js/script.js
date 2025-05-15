const tabUsuario = document.getElementById('tab-usuario');
const tabAdmin = document.getElementById('tab-admin');

tabUsuario.addEventListener('click', () => {
    tabUsuario.classList.add('active');
    tabAdmin.classList.remove('active');
    
});

tabAdmin.addEventListener('click', () => {
    window.location.href = "cadastroadm.php"; 
});