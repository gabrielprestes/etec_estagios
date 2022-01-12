<?php 
if (!isset($_SESSION))
{//Verificar se a sessão não já está aberta.
  session_start();
}
header('Set-Cookie: cross-site-cookie=name; SameSite=None; Secure');

include_once "config/config.php"; //incluindo a classe ConexaoBD
$connection = new ConexaoBD();
?>
<!DOCTYPE html>

<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Gabriel">

  <title>ETEC Sales Gomes - Estágios</title>
  <link rel="shortcut icon" href="img/favicon.ico"/>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/fontgoogleapi/Montserrat.css" rel="stylesheet" type="text/css">
  <link href="vendor/fontgoogleapi/Lato.css" rel="stylesheet" type="text/css">

  <!-- Plugin CSS -->
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="css/freelancer.min.css" rel="stylesheet">


  <!-- TAMANHO DOS BOTÕES DE DOWNLOAD DE DOCUMENTOS -->
  <style>
    .mesmo-tamanho {
      width: 40%;
      white-space: normal;
    }
  </style>

</head>

<body id="page-top">
  <!-- Navigation -->
  <!-- Barra no Topo da Página -->
  <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="img/logoEtec.png" width="18%">Estágios</a>
      <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">

         <li class="nav-item mx-0 mx-lg-1">
          <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#mural">Mural</a>
        </li>
        <li class="nav-item mx-0 mx-lg-1">
          <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#documentacao">Documentação</a>
        </li>
        <li class="nav-item mx-0 mx-lg-1">
          <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contato">Contato</a>
        </li>

        <!------------- Exibir LOGIN ou PAINEL USUÁRIO na navbar ----------------->
        <!-- Verifica se está logado ou não -->
        <?php 
        if (isset($_SESSION['nomeUsuario'])) 
        {
            //Se existir, exibe "Painel do Usuário"
          ?>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="painelUsuario.php">Painel</a>      
          </li>
          <?php 
        }        
        else
        {
            //Se não existir, exibe "Login" que leva ao Modal
          ?>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" data-toggle="modal" data-target="#modalLogin" href="">Login</a>      
          </li>
        <?php }
        ?>
      </ul>
      <!--------------------------------------------------------------------------->
    </div>
  </div>
</nav>

<!-- Header -->
<!-- Cabeçalho da Página - Parte Inicial -->
<header class="masthead bg-primary text-white text-center">
  <div class="container">
    <img class="img-fluid mb-5 d-block mx-auto" src="img/logoEtec.png" alt="Etec Sales Gomes">

    <h1 class="text-uppercase mb-0">Central de Estágios</h1>
    <h2 class="font-weight-light mb-0">Plataforma de Estágios</h2><br/>
    <img src="img/icones/icons8-profiles-160.png">
    <p style="text-align: justify; font-size: 20px;">
    A Etec Sales Gomes possuí a modalidade de Estágio Não Obrigatório Supervisionado em sua grade curricular, mas tratamos desta prática com extrema importância para o desenvolvimento profissional de nossos estudantes. A Etec possuí um bom relacionamento com diversas Empresas da Região, que por sua vez indicam grande satisfação em contar com nossos alunos, principalmente pelo comprometimento Ético e as Habilidades Técnicas desempenhadas.</p>

    <!------------- Exibir LOGIN ou PAINEL USUÁRIO na navbar ----------------->
    <!-- Verifica se está logado ou não -->
    <?php 
    if (isset($_SESSION['idUsuario'])) 
    {
            //Se existir, exibe "Painel do Usuário"
      ?>
      <h2>Bem-Vindo <?php echo $_SESSION['nomeUsuario']; ?></h2><br>
      <a class="btn btn-primary btn-xl" href="painelUsuario.php"> <i class="fa fa-user-circle" aria-hidden="true"> Painel do Usuário</i></a><br><br>
      <form method="POST" action="config/login.php">
        <button type="submit" class="btn btn-primary btn-xl" name="btnSair"><i class="fa fa-window-close" aria-hidden="true"> Sair</i></button>
      </form>
      <?php 
    }        
    else
    {
            //Se não existir, exibe "Cadastrar"
      ?>
      <h4>Usuário</h4>
      <a href="cadastroAluno.php" class="btn btn-primary btn-xl" id="sendMessageButton">Cadastrar-se</a>
      <a href="#" class="btn btn-primary btn-xl" data-toggle="modal" data-target="#modalLogin" href="">Efetuar Login</a>  
    </div>
    <?php
  }
  ?>
</header>

<!-- Portfolio Grid Section -->
<section class="portfolio" id="mural">
  <div class="container">
    <h2 class="text-center text-uppercase text-secondary mb-0">Mural</h2>
    <hr class="mb-5">
    <p class="lead" style="text-align: justify;">As <b>empresas</b> que desejam contar com estagiários, podem solicitar todo apoio necessário através do e-mail <a href="mailto:e101ata@cps.sp.gov.br">e101ata@cps.sp.gov.br</a> que além do suporte pelo próprio e-mail, também trabalhamos com visitas nas empresas para auxiliar nessa prática (sem custo algum para empresa).</p>
    <!--<p class="lead" style="text-align:center;">
      <a  class="btn btn-primary btn-lg" href="https://www.etecsalesgomes.com.br/painel/kcfinder/upload/files/Arquivos/Relacoes_Institucionais/2020/Aprendiz/Perguntas_e_respostas_MP936_2020.pdf.pdf" target="_blank">Perguntas Frequentes</a>
    </p>-->
    <br/>

    <!-------------------- Criando card com informações e imagens -------------------->
    <?php 
    $status = "Ativo";
    //Listar todas as vagas com base no ID da empresa e que não estejam com status "Inativo";
    $sql = "SELECT * FROM vagas WHERE status=? ORDER BY idVaga";       
    $dados = array($status);
    try
    {
     $resultado = $connection->executar($sql,$dados,true);
     ?>

     <div class="row">
      <?php 
      foreach ($resultado as $row)
      {
              //montagem da vaga em card
        ?>            
        <div class="col-sm-4">
          <div class="card">
            <!--<img class='card-img-top' src='img/vaga_estagio.jpg' alt='Imagem de capa do card'>-->
            <div class='card-body'>
              <h5 class='card-title'><?php echo $row['titulo']?></h5>
              <p class='card-text'>
                <img src="img/vaga_estagio.png" alt="icone vaga">
                <form method="POST" action="config/inscricao.php">
                 <input type="hidden" name="idVaga" value='<?php echo $row['idVaga'];?>'</td><!-- ID da Vaga -->
                 <td><b>Cidade:</b><?php echo $row['cidade']?></td><br/>
                 <td><b>Área:</b><?php echo $row['area']?></td><br/>
                 <td><?php echo "<b>Descrição:</b><br/>".$row['descricao']?></td><br/>
                 <!--<td><?php echo "IdEmpresa:".$row['idEmpresa']?></td><br/>-->
                 <td><?php echo "<b>Data de Cadastro:</b>".$row['dataCadastro']?></td><br/>
               </p>

               <?php                 
                     //Verifica se o usuário logado é do tipo aluno para aparecer o botão inscrever
               if (isset($_SESSION['tipoUsuario'])) 
               {

                 if ((($_SESSION['tipoUsuario']=="Aluno") && ($_SESSION['status']=="Ativo") && ($_SESSION['curriculo']!=NULL)))
                 {
                      // Faz a verificação no banco de dados se já está inscrito
                  $sqlVerifica = "SELECT * FROM inscricao WHERE idAluno = ? AND idVaga=?";
                  $dadosVerifica = array($_SESSION['idUsuario'],$row['idVaga']);

                      //Se tiver inscrito, aparece o botão "Cancelar Inscrição"
                  if(count($connection->executar($sqlVerifica,$dadosVerifica,true))>0)
                  {
                   ?>
                   <button type="submit" class="btn btn-danger" name="btnCancelarInscrever">Cancelar Inscrição</button>
                   <?php 
                        } //fecha if do count
                      //Se não tiver, mostra "Inscrever-se"
                        else
                        {
                          ?>
                          <button type="submit" class="btn btn-primary" name="btnInscrever">Inscrever-se</button>
                          <?php 
                        } //fecha else
                      }//fecha if do tipoUsuario==Aluno

                      else
                      {
                        ?>
                        <p style="color: red"><b>Para se inscrever anexe seu currículo e aguarde a liberação do seu cadastro pelo Administrador</b></p>
                        <?php 
                      }
                    }
                    ?>

                  </form>
                </div>

              </div>
              <br/>
            </div>
            <?php 
          }//fecha for each
        }//fecha try
        catch(PDOException $e)
        {
          echo $e->getMessage();
        }//fecha catch
        ?>
      </div>
    </div>
  </div>


    <!-- CARROSSEL  DE IMAGENS -->
    <center>
      <h4 style="text-align: center;">Agências de Integração</h4>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="width: 30%;">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">

            <a href="https://www.nube.com.br" target="_blank"><img class="d-block w-100" src="img/agencias/nube.png" alt="Primeiro Slide - Nube"></a>
          </div>

          <div class="carousel-item">
            <a href="http://www.agilizaestagio.com.br" target="_blank"><img class="d-block w-100" src="img/agencias/agiliza.png" alt="Segundo Slide - Agiliza"></a>
          </div>

          <div class="carousel-item">
            <a href="https://www.ciadeestagios.com.br" target="_blank"><img class="d-block w-100" src="img/agencias/cia.png" alt="Terceiro Slide - CIA"></a>
          </div>

          <div class="carousel-item">
            <a href="http://www.ciee.org.br" target="_blank"><img class="d-block w-100" src="img/agencias/ciee.png" alt="Quarto Slide - CIEE"></a>
          </div>

          <div class="carousel-item">
            <a href="http://www.icae.org.br" target="_blank"><img class="d-block w-100" src="img/agencias/icae.png" alt="Quinto Slide - Icae"></a>
          </div>

          <div class="carousel-item">
            <a href="http://www.smartestagio.com.br" target="_blank"><img class="d-block w-100" src="img/agencias/smart.png" alt="Sexto Slide - Smart Estágios"></a>
          </div>

          <div class="carousel-item">
            <a href="http://www.superestagios.com.br" target="_blank"><img class="d-block w-100" src="img/agencias/superEstagios.png" alt="Sétimo Slide - Super Estágios"></a>
          </div>

        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Próximo</span>
        </a>
      </div>
    </center>
    <!-- ENCERRA CARROSSEL -->
  </div>



</section>

<!-- Seção - Documentacao -->
<section class="bg-primary text-white mb-0" id="documentacao">
  <div class="container">
    <h2 class="text-center text-uppercase text-white">Documentação de Estágio</h2>
    <hr class="mb-5">  <!-- <hr class="star-light mb-5">-->
<!-- <div align="center">
<a class="portfolio-item btn btn-primary btn-xl" href="#portfolio-modal-7">Visualizar Informações</a>
</div>
-->

<h3 style="text-align: center;">Documentos Importantes</h3>
<p class="lead" style="text-align: justify;">
 A formalização do estágio deve ser realizada entre Empresa, Etec e Aluno através do "Termo de Compromisso de Estágio" (Documento disposto logo no link abaixo). Para as empresas que atuam há mais tempo na área de Estágios destacamos que não é mais obrigatória nenhuma formalização de Termos de Convênios para que o contrato seja realizado. 
 <div align="center">
  <a class="btn btn-outline-light mesmo-tamanho" href="documentos/Termo_de_Compromisso_de_Estágio_2021.docx">
    <i class="fas fa-download mr-2"></i>Termo de Compromisso - 2021</a>
    <br/>

    <a class="btn btn-outline-light mesmo-tamanho" href="documentos/instrucao2020.pdf" target="_blank">
      <i class="fas fa-download mr-2"></i>Instrução de Estágio Supervisionado</a>

      <br><br><br>
      <h3>Instrução de Estágio Supervisionado</h3>
      <p class="lead" style="text-align: justify;">
        Os modelos de documentos para o estágio deverão ser entregues na sequência determinada abaixo e deverão ser elaborados preferencialmente em Word, porém também estão sendo aceitos de maneira manuscrita, desde que o aluno modifique a formatação para elaboração dos relatórios.
      </p>
      <a class="btn btn-outline-light mesmo-tamanho" href="documentos/01.fichadeacompanhamento.docx">
        <i class="fas fa-download mr-2"></i>01 - Ficha de Acompanhamento</a>

        <a class="btn btn-outline-light mesmo-tamanho" href="documentos/02.fichadeinicio.docx">
          <i class="fas fa-download mr-2"></i>02 - Ficha de Início de Estágio</a>

          <a class="btn btn-outline-light mesmo-tamanho" href="documentos/03.relatorioperiodico.docx">
            <i class="fas fa-download mr-2"></i>03 - Relatório Periódico</a>

            <a class="btn btn-outline-light mesmo-tamanho" href="documentos/04.relatoriofinal.docx">
              <i class="fas fa-download mr-2"></i>04 - Relatório Final de Estágio</a>

              <a class="btn btn-outline-light mesmo-tamanho" href="documentos/05.fichadeavaliacao.docx">
                <i class="fas fa-download mr-2"></i>05 - Ficha de Avaliação de Estágio</a>

                <a class="btn btn-outline-light mesmo-tamanho" href="documentos/07.declaracaoconclusao.doc">
                  <i class="fas fa-download mr-2"></i>06 - Declaração de Conclusão</a>
                </div>
                
                <br><br>
                <h3 style="text-align: center;">Avaliação das Empresas</h3>
                <p class="lead" style="text-align: justify;">Na busca de apresentar sempre a melhor mão de obra da região, pedimos periodicamente que as Empresas avaliem nossos Estagiários, assim como os Procedimentos adotados pela Etec, utilizando este Canal como forma de apresentar para Etec necessidades atuais, que por sua vez serão discutidas junto a Equipe de Gestão.</p>
                <div align="center">
                  <a class="btn btn-outline-light" target="_blank" href="https://docs.google.com/forms/d/e/1FAIpQLSdTZXeo09XwPss6wTal9K-b4vk3PK4Oy3feP3SMVe50a7k2IQ/viewform">
                    <i class="fas fa-download mr-2"></i>Avaliação das Empresas</a>
                  </div>

                  <br><br>
                  <h3 style="text-align: center;">Pesquisa de Satisfação - Estagiários</h3>
                  <p class="lead" style="text-align: justify;">
                    A Prática de estágio é Não-obrigatória e o objetivo é preparar cada vez mais o Aluno ao Mercado de Trabalho. Com isso, entender o quanto nosso aluno está satisfeito com esta prática e Crucial para que possamos desenvolver este trabalho. Com isso, faça a avaliação abaixo, trazendo-nos esta informação.
                  </p>
                  <div align="center">
                    <a class="btn btn-outline-light" target="_blank" href="https://docs.google.com/forms/d/e/1FAIpQLSf1WD1Wr35YZtUoFJizssAS8EWLjN8hBNhil40myGva6oSpcw/viewform">
                      <i class="fas fa-download mr-2"></i>Pesquisa de Satisfação - Estagiários</a>

                      <br><br>
                      <h3 style="text-align: center;">Equivalência de Estágio</h3>
                      <p class="lead" style="text-align: justify;">
                       Aos ex-alunos que cursaram o Ensino Técnico na Etec Sales Gomes e ainda não realizaram os Procedimentos de Estágio, que era Obrigatório, se obtiveram Experiência Profissional que possa ser comprovada, existe a possibilidade de Solicitar a Equivalência de Estágio. Foi elaborada uma Instrução, com intuito de auxiliar no desenvolvimento desta Atividade, assim como os Modelos seguem abaixo para elaboração do Processo.
                     </p>

                     <a class="btn btn-outline-light mesmo-tamanho" href="documentos/Equivalencia/00.instrucaoequivalencia.doc"><i class="fas fa-download mr-2"></i>Instrução</a>

                     <a class="btn btn-outline-light mesmo-tamanho" href="documentos/Equivalencia/01.listadocumentos.docx">
                      <i class="fas fa-download mr-2"></i>Documentos da Equivalência</a>

                      <a class="btn btn-outline-light mesmo-tamanho" href="documentos/Equivalencia/02.fichaEquivalencia.doc">
                        <i class="fas fa-download mr-2"></i>Ficha de Equivalência</a>

                        <a class="btn btn-outline-light mesmo-tamanho" href="documentos/Equivalencia/03.RelatorioEquivalencia.docx">
                          <i class="fas fa-download mr-2"></i>Relatório de Equivalência</a>

                        </div>
                        

                        <br><br>
                        <h3 style="text-align: center;">Material Complementar</h3>
                        <p class="lead" style="text-align: justify;">
                          Buscando melhorar cada vez mais as atividades relacionadas ao desenvolvimento de Estágios Supervisionados não obrigatórios, estamos reelaborando os modelos e documentos para tornar mais efetivo o controle.
                          <div align="center">


                            <a class="btn btn-outline-light mesmo-tamanho" href="documentos/Material/01.Lei_de_Estagio.doc">
                              <i class="fas fa-download mr-2"></i>Lei de Estágio</a>

                              <a class="btn btn-outline-light mesmo-tamanho" target="_blank" href="documentos/Material/CartilhaDeEstagioAbres.pdf">
                                <i class="fas fa-download mr-2"></i>Cartilha de Estágio - ABRES</a>

                                <a class="btn btn-outline-light mesmo-tamanho" target="_blank" href="documentos/Material/CartilhaMTE.pdf">
                                  <i class="fas fa-download mr-2"></i>Cartilha de Estágio - MTE</a>

                                  <a class="btn btn-outline-light mesmo-tamanho" target="_blank" href="documentos/Material/Estagio_Supervisionado.pdf">
                                    <i class="fas fa-download mr-2"></i>Apresentação de Estágio</a>

                                    <a class="btn btn-outline-light mesmo-tamanho" href="documentos/Material/DECLARACAO_DE_RECESSO_DE_ESTAGIO.docx">
                                      <i class="fas fa-download mr-2"></i>Recesso de Estágio (Modelo para Empresas)</a>

                                      <a class="btn btn-outline-light mesmo-tamanho" href="documentos/Material/ TERMO_DE_ENCERRAMENTO.docx">
                                        <i class="fas fa-download mr-2"></i>Termo de Encerramento de Estágio (Modelo)</a>

                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div> 
                            </section>



                            <!-- Seção Contato -->
                            <section id="contato">
                              <div class="container">
                                <h2 class="text-center text-uppercase text-secondary mb-0">Contato</h2>

                                <hr class="mb-5"><!--<hr class="star-dark mb-5">-->
                                <div class="row">
                                  <div class="col-lg-8 mx-auto">

                                    <div align="center">
                                      <p><b>E-mail de contato:</b> e101ata@cps.sp.gov.br</p>
                                      <p><b>Telefone:</b> (15) 3251 4242 (Ramal 33)</p>
                                      <h4>Atendimento de Estagiários - Jeferson Nedelciu</h4>
                                      <table class="table table-hover">
                                        <thead class="thead-dark">
                                          <th scope="row"></th>
                                          <th scope="row">Manhã</th>
                                          <th scope="row">Tarde</th>
                                          <!--<th scope="row">Noite</th>-->
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <th scope="row">Segunda-Feira</th>
                                            <td>08h00 às 12h00</td>
                                            <td>13h00 às 17h00</td>
                                            <!-- <td>19h00 às 23h00</td> -->
                                          </tr>
                                          <tr>
                                            <th scope="row">Terça-Feira</th>
                                            <td>08h00 às 12h00</td>
                                            <td>13h00 às 17h00</td>
                                            <!--<td>18h30 às 20h30</td>-->
                                          </tr>
                                        </tr>
                                        <tr>
                                          <th scope="row">Quarta-feira</th>
                                          <td>08h00 às 12h00</td>
                                          <td>13h00 às 17h00</td>
                                          <!--<td>19h00 às 23h00</td>-->
                                        </tr>

                                        <tr>
                                          <th scope="row">Quinta-feira</th>
                                          <td>08h00 às 12h00</td>
                                          <td>13h00 às 17h00</td>
                                          <!--<td>19h00 às 23h00</td>-->
                                        </tr>

                                        <tr>
                                          <th scope="row">Sexta-feira</th>
                                          <td>08h00 às 12h00</td>
                                          <td>13h00 às 17h00</td>
                                          <!--<td>18h30 às 20h30</td>-->
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </section>

                          <!-- Footer -->
                          <footer class="footer text-center">
                            <div class="container">
                              <div class="row">

                                <div class="col-md-4">
                                  <h4 class="text-uppercase mb-4">Contato</h4>
                                  <p class="lead mb-0">Jeferson Nedelciu</p>
                                  <p class="lead mb-0">Telefone: 15 3251-4242 (Ramal 33)</p>
                                  <p class="lead mb-0">E-mail: e101ata@cps.sp.gov.br</p>
                                  <a href="https://www.facebook.com/etecsalesgomesoficial/" target="_blank"><i class="fa fa-thumbs-up" aria-hidden="true"> Facebook da ETEC</i></a>
                                </a>
                              </div>

                              <div class="col-md-4 mb-5 mb-lg-0">
                                <h4 class="text-uppercase mb-4">Endereço</h4>
                                <p class="lead mb-0">ETEC Sales Gomes - Praça Adelaide B. Guedes nº 01, Centro - Tatuí/SP</p>
                                <p class="lead mb-0">18270-020</p>
                              </div>

                              <div class="col-md-4 mb-5 mb-lg-0">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3663.159131311635!2d-47.8475949854848!3d-23.346248684790126!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c5d92ba0c5107d%3A0x7ed3c17aec5ab394!2sETEC+Sales+Gomes!5e0!3m2!1spt-BR!2sbr!4v1551403126166" width="340" height="260" frameborder="0" style="border:0" allowfullscreen></iframe>
                              </div>
                            </div>
                          </div>
                        </footer>
                        <div class="copyright py-4 text-center text-white">
                          <div class="container">
                            <a href="http://www.etecsalesgomes.com.br" target="_blank">
                              <img src="img/logoEtec.png" width="8%" alt="Etec Sales Gomes">
                              <img src="img/cpsbranco.png" width="30%" alt="Etec 50 anos">
                            </a>
                            <br/><br/>
                            <p><em>Site desenvolvido por Gabriel Prestes Américo - Versão Beta 01 - 2020</em></p>
                          </div>
                        </div>

                        <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
                        <div class="scroll-to-top d-lg-none position-fixed ">
                          <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
                            <i class="fa fa-chevron-up"></i>
                          </a>
                        </div>


                        <!-- MODAL LOGIN  -->
                        <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form action="config/login.php" method="POST">
                                  <div>

                                   <div class="col-auto">

                                    <label class="" for="email"><b>Email</b></label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                    <br/>
                                    <label for="senha"><b>Senha</b></label>
                                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                                    <br/>
                                    <button type="submit" name="btnLogar" class="form-control btn btn-primary">Login</button>
                                  </div>
                                  <div class="modal-footer">
                                    <p class="font-weight-light">Caso tenha problemas com acesso, entre em contato no email:
                                      <a href="mailto:estagiario.coordenacao101@etec.sp.gov.br">estagiario.coordenacao101@etec.sp.gov.br</a></p>
                                      <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>-->
                                    </div>              
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- FECHA LOGIN -->

                          <!-- Bootstrap core JavaScript -->
                          <script src="vendor/jquery/jquery.min.js"></script>
                          <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                          <!-- Plugin JavaScript -->
                          <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
                          <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

                          <!-- Contact Form JavaScript -->
                          <script src="js/jqBootstrapValidation.js"></script>
                          <script src="js/contact_me.js"></script>

                          <!-- Custom scripts for this template -->
                          <script src="js/freelancer.min.js"></script>

                        </body>

                        </html>
