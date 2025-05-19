<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
    href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css"
    rel="stylesheet" />
  <link rel="stylesheet" href="css/style8.css" />
  <title>BomFim Contabilidade</title>
</head>

<body>
  <nav>
    <div class="nav__logo">
      <a href="#"><img src="images/logo.png" alt="logo" /></a>
    </div>
    <ul class="nav__links">
      <li class="link"><a href="home.php">Inicio</a></li>
      <li class="link"><a href="gerenciamento_Empresas.php">Gerenciamento de empesas</a></li>
      <li class="link"><a href="#">Equipe</a></li>
    </ul>
    <div class="logout-button">
      <a href="index.php"><img src="images/icon_desconect2.png" alt="Logout"></a>
    </div>
  </nav>

  <header class="section__container header__container">
    <div class="header__content">
      <h4>Pode ficar tranquilo, seu negócio é da nossa conta.</h4>
      <h1>EMPRESA<span> BOMFIM CONTABILIDADE</span></span></h1>
      <p>
        Oferecemos serviços contábeis completos, com foco em eficiência, transparência e crescimento sustentável para o seu negócio....
      </p>
    </div>
    <div class="header__image">
      <img src="images/header.jpg" alt="header" />
    </header>
    
    <section class="section__container price__container">
      <h2 class="section__header">DOWNLOAD DAS NOTAS</h2>
      <p class="section__subheader">
        Metodos para realização de processor automatizador para inserção das notas...
      </p>
      <div class="section_price__card">
        <div class="price__grid">
          <div class="price__card">
              <h4><p><i class="ri-arrow-down-circle-fill"></i>DOWNLOARD</p></h4>
              <h3>FIST</h3>
            <form action="executar_script.php" method="post" style="display:inline;">
              <button type="submit" class="btn price__btn">Inicia</button>
            </form>
          </div>
        </div>
  
        <div class="price__grid">
          <div class="price__card">
              
              <h4><p><i class="ri-arrow-down-circle-fill"></i>DOWNLOARD</p></h4>
              <h3>DANFE</h3>
            <form action="executar_nfe_downloader.php" method="post" style="display:inline;">
              <button type="submit" class="btn price__btn">Inicia</button>
            </form>
          </div>
        </div>
      </div>
    </section>
    
  <section class="section__container explore__container">
    <h2 class="section__header">RELATORIO DE EXECUÇÃO </h2>
    <p class="section__subheader">
      Detalhe das ultimas execusões feitas pelo sistema...
    </p>
    <div class="explore__header">

      <div class="explore__grid">
        <div class="explore__card">
          <span><i class="ri-boxing-fill"></i></span> <!-- * Total processadas -->
          <h4>Total processadas</h4>
          <h3><?= $stats['total'] ?></h3>
        </div>
      </div>

      <div class="explore__grid">
        <div class="explore__card">
          <span><i class="ri-boxing-fill"></i></span> <!-- * Com sucesso -->
          <h4>Com Sucesso</h4>
          <h3><?= $stats['sucesso'] ?></h3>
        </div>
      </div>

      <div class="explore__grid">
        <div class="explore__card">
          <span><i class="ri-boxing-fill"></i></span> <!-- * ÍCom erro -->
          <h4>Com Erro</h4>
          <h3><?= $stats['erro'] ?></h3>
        </div>
      </div>
      <div class="explore__grid">
        <div class="explore__card">
          <span><i class="ri-boxing-fill"></i></span> <!-- * Duração -->
          <h4>Com Erro</h4>
          <h3><?= number_format($stats['duracao_media'], 2) ?></h3>
        </div>
      </div>
    </div>
  </section>
  <!--
     <div class="explore__nav">
      <span><i class="ri-arrow-left-line"></i></span>   
      <span><i class="ri-arrow-right-line"></i></span>  
  -->
  <!--
  <section class="section__container class__container">
    <div class="class__content">
      <h2 class="section__header">DOWNLOAD DAS NOTAS</h2>

      <button class="btn">Download pelo FSist</button>
      <button class="btn">Download pelo Danfe</button>
    </div>
  </section>
 -->


  <section class="review">
    <div class="section__container review__container">
      <span><img src="images/logo_flownotas.png" alt="logo_equipe"></i></span>
      <div class="review__content">
        <h1>Equipe</h1>
        <p>
          O que realmente diferencia a empresa é sua equipe especializada...
        </p>
        <div class="review__footer">
          <div class="review__member">
            <img src="images/WhatsApp Image 2025-05-04 at 20.07.46.jpeg" alt="Alice Barbosa" class="card-img-top rounded-3">
            <div class="card-body text-center">
              <p class="card-text">Alice Barbosa</p>
              <p>Desenvolvedor de Software</p>
            </div>
          </div>
          <div class="review__footer">
            <div class="review__member">
              <img src="images/WhatsApp Image 2025-05-04 at 13.33.08.jpeg" alt="Breno Araújo" class="card-img-top rounded-3">
              <div class="card-body text-center">
                <p class="card-text">Breno Araújo</p>
                <p>Desenvolvedor de Software</p>
              </div>
            </div>
            <div class="review__footer">
              <div class="review__member">
                <img src="images/WhatsApp Image 2025-05-04 at 20.05.44.jpeg" alt="Luan Borges" class="card-img-top rounded-3">
                <div class="card-body text-center">
                  <p class="card-text">Luan Borges</p>
                  <p>Desenvolvedor de Software</p>
                </div>
              </div>
            </div>
            <div class="review__footer">
              <div class="review__member">
                <img src="images/WhatsApp Image 2025-05-04 at 20.06.24.jpg" alt="Samir Silva" class="card-img-top rounded-3">
                <div class="card-body text-center">
                  <p class="card-text">Samir Silva</p>
                  <p>Desenvolvedor de Software</p>
                </div>
              </div>
            </div>
          </div>
        </div>
  </section>
</body>

</html>