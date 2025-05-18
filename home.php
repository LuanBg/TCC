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
      <li class="link"><a href="#">Cadastro</a></li>
      <li class="link"><a href="#">Gerenciamento de Usuário</a></li>
      <li class="link"><a href="#">Gerenciamento de empesas</a></li>
      <li class="link"><a href="#">Equipe</a></li>
      <li class="link"><a href="#">Sobre</a></li>
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

  <section class="section__container explore__container">
    <div class="explore__header">
      <h2 class="section__header">RELATORIO DE EXECUÇÃO </h2> <!-- * Título da seção para explorar o programa -->
      <!--
         <div class="explore__nav">
          <span><i class="ri-arrow-left-line"></i></span>   * Ícone de seta para a esquerda 
          <span><i class="ri-arrow-right-line"></i></span>  * Ícone de seta para a direita 
        </div> 
    -->
    </div>
    <div class="explore__grid">
      <div class="explore__card">
        <span><i class="ri-boxing-fill"></i></span> <!-- * Ícone de boxe -->
        <h4>Toltal processadas</h4>
        <div class="row g-4">
          <div class="col-md-3">
            <h3><?= $stats['total'] ?></h3>
          </div>
        </div>
      </div>
      <!-- * Repetição dos cards de diferentes programas, com seus respectivos ícones, títulos, descrições e links -->
    </div>
    <div class="explore__grid">
      <div class="explore__card">
        <span><i class="ri-boxing-fill"></i></span> <!-- * Ícone de boxe -->
        <h4>Toltal processadas</h4>
        <p>
          Abrace a essência da força enquanto exploramos suas várias dimensões...
        </p>
      </div>
      <!-- * Repetição dos cards de diferentes programas, com seus respectivos ícones, títulos, descrições e links -->
    </div>
    <div class="explore__grid">
      <div class="explore__card">
        <span><i class="ri-boxing-fill"></i></span> <!-- * Ícone de boxe -->
        <h4>Toltal processadas</h4>
        <p>
          Abrace a essência da força enquanto exploramos suas várias dimensões...
        </p>
      </div>
      <!-- * Repetição dos cards de diferentes programas, com seus respectivos ícones, títulos, descrições e links -->
    </div>
  </section>

  <section class="section__container class__container">
    <div class="class__image">
      <span class="bg__blur"></span> <!-- * Efeito de desfoque aplicado ao fundo da imagem -->
      <img src="images/class-1.jpg" alt="aula" class="class__img-1" /> <!-- * Imagem representando uma aula -->
      <img src="images/class-2.jpg" alt="aula" class="class__img-2" /> <!-- * Segunda imagem representando uma aula -->
    </div>
    <div class="class__content">
      <h2 class="section__header">AULA QUE VOCÊ ENCONTRARÁ AQUI</h2> <!-- * Título da seção sobre as aulas oferecidas -->
      <p>
        Liderada pela nossa equipe de instrutores especialistas...
      </p>
      <button class="btn">Reservar uma Aula</button> <!-- * Botão de ação para reservar uma aula -->
    </div>
  </section>

  <section class="section__container join__container">
    <h2 class="section__header">POR QUE SE JUNTAR A NÓS?</h2> <!-- * Título sobre os benefícios de se juntar ao programa -->
    <p class="section__subheader">
      Nossa base de membros diversificada cria uma atmosfera amigável...
    </p>
    <div class="join__image">
      <img src="images/join.jpg" alt="Junte-se" /> <!-- * Imagem relacionada à adesão ao programa -->
      <div class="join__grid">
        <!-- * Cards com ícones e informações sobre os benefícios do programa (Personal Trainer, Sessões de Prática, Boa Gestão) -->
      </div>
    </div>
  </section>

  <section class="section__container price__container">
    <h2 class="section__header">NOSSO PLANO DE PREÇOS</h2> <!-- * Título da seção sobre planos de preços -->
    <p class="section__subheader">
      Nosso plano de preços oferece diferentes níveis de adesão...
    </p>
    <div class="price__grid">
      <div class="price__card">
        <div class="price__card__content">
          <h4>Plano Básico</h4>
          <h3>$16</h3> <!-- * Detalhamento dos planos de preços -->
          <p><i class="ri-checkbox-circle-line"></i> Plano de treino inteligente</p>
          <!-- * Benefícios listados para o plano -->
        </div>
        <button class="btn price__btn">Junte-se Agora</button> <!-- * Botão para se inscrever no plano -->
      </div>
      <!-- * Repetição de cards de planos de preços com detalhes e botão de adesão -->
    </div>
  </section>

  <section class="review">
    <div class="section__container review__container">
      <span><i class="ri-double-quotes-r"></i></span> <!-- * Ícone de aspas para o feedback -->
      <div class="review__content">
        <h4>AVALIAÇÃO DOS MEMBROS</h4> <!-- * Título da seção de avaliações -->
        <p>
          O que realmente diferencia esta academia é sua equipe especializada...
        </p>
        <div class="review__rating">
          <!-- * Ícones de estrelas para avaliação -->
        </div>
        <div class="review__footer">
          <div class="review__member">
            <img src="images/Captura de tela 2024-12-12 095641.png" alt="membro" /> <!-- * Imagem do membro que fez a avaliação -->
            <div class="review__member__details">
              <h4>Luan Borges</h4>
              <p>Desenvolvedor de Software</p>
            </div>
          </div>
          <div class="review__member">
            <img src="images/Captura de tela 2024-12-12 095559.png" alt="membro" /> <!-- * Imagem do membro que fez a avaliação -->
            <div class="review__member__details">
              <h4>Samir </h4>
              <p>Desenvolvedor de Software</p>
            </div>
          </div>
          <div class="review__nav">
            <span><i class="ri-arrow-left-line"></i></span> <!-- * Navegação entre avaliações -->
            <span><i class="ri-arrow-right-line"></i></span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="section__container footer__container">
    <span class="bg__blur"></span> <!-- * Efeito de desfoque aplicado ao fundo do rodapé -->
    <div class="footer__col">
      <div class="footer__logo"><img src="images/logo (1).png" alt="logo" /></div> <!-- * Logo do rodapé -->
      <p>
        Dê o primeiro passo rumo a um você mais saudável...
      </p>
      <div class="footer__socials">
        <a href="#"><i class="ri-facebook-fill"></i></a>
        <!-- * Links para redes sociais -->
      </div>
    </div>
    <!-- * Outras seções do rodapé com links de contato e informações sobre a empresa -->
  </footer>
  <div class="footer__bar">
    Copyright © 2023 Fitclub. Todos os direitos reservados.
  </div> <!-- * Copyright do site -->
</body>

</html>