<?php 
session_start();
//verifica se tem valor na variavel da sessão
if (isset($_SESSION['idUsuario']))
{
  ?>

  <!DOCTYPE html>
  <html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Gabriel">

    <title>Painel do Usuário</title>
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
  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php"><img src="img/logoEtec.png" width="20%">Estágios</a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded" href="index.php">Página Inicial</a>
            </li>

            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded" href="dadosUsuario.php">Conta</a>      
            </li>

            <!-- Sair -->
            <li class="nav-item mx-0 mx-lg-1">
             <a class="nav py-3 px-0 px-lg-3 rounded" href="config/login.php">Sair</a>      
           </li>
         </ul>
       </div>
     </div>
   </nav>


   <!-- Header -->
   <header class="masthead bg-primary text-white text-center">
    <div class="container">
      <h1 class="text-uppercase mb-0">Painel do Usuário</h1>
      <br/>
      <img src="img/icones/user-80.png">
      <h2 class="font-weight-light mb-0">

      </h2>
      <!-- Exibe o nome do Usuário no topo da Página -->
      <h2 class="font-weight-light mb-0"><?php echo $_SESSION['nomeUsuario']; ?></h2>
      <h2 class="font-weight-light mb-0">Gerencie o seu cadastro</h2>

    </div>
  </header>

  <section id="formularioCadastro">
    <div class="container">
      <h2 class="text-center text-uppercase text-secondary mb-0">Opções</h2>
      <hr class="mb-5">
      <div class="row">
        <div class="col-lg-8 mx-auto">

          <p class="text-center"><a class="btn btn-primary" href="dadosUsuario.php"><i class="fa fa-user-circle" aria-hidden="true"> Gerenciar Conta</i></a><br/><br/>
            <a class="btn btn-primary" href="painelInscricoes.php"><i class="fa fa-envelope" aria-hidden="true"> Painel de Inscrições</i></a>
            <?php 
              //Verifica se é Administrador
            if ($_SESSION['status']=="Admin") 
            {
             ?>
             <a class="btn btn-primary" href="painelVagas.php"><i class="far fa-list-alt" aria-hidden="true"> Painel de Vagas</i></a>
             <a class="btn btn-primary" href="painelAlunos.php"><i class="fa fa-id-badge" aria-hidden="true"> Painel de Alunos</i></a>
             
             <?php 
             /* Verifica a quantidade de alunos Pendentes */
             include_once "config/config.php";
             $connection = new ConexaoBD();
            $sqlAluno = "SELECT * FROM aluno WHERE status=?";
            $dados = array('Pendente');

            $resultado = count($connection->executar($sqlAluno,$dados,true));
                echo "<br/><br/><h4>Alunos Pendentes: $resultado</h4>";
           }

           if ($_SESSION['tipoUsuario']=="Aluno") 
           {
            include_once "config/config.php"; //incluindo a classe ConexaoBD
            $connection = new ConexaoBD();

            /* Consulta do Curriculo Cadastrado */
            $sql = "SELECT * FROM aluno WHERE idAluno=?";
            $dados = array(($_SESSION['idUsuario']));

            $resultado = $connection->executar($sql,$dados,true);
            foreach ($resultado as $row)
            {
              ?>
              <!-- Exibe os campos da tabela -->
              <?php 
              
              if ($row['curriculo']==NULL)
              {

                echo "<br/><br/>Currículo não anexado!";
              }

              else
              {
               ?>
               <br/><br/>
               <a href="curriculos/<?php echo $row['curriculo']; ?>" download><i class="fas fa-download mr-2" aria-hidden="true"> Baixar Currículo</i></a>
               <?php 
             }
             ?>

             <a class='btn btn-info' href='' data-toggle='modal' data-target='#modalCurriculo'><i class='fa fa-paper-plane' aria-hidden='true'> Anexar Curriculo</i></a>

               <br/><br/>
             <h5>Status: <?php echo $row['status'];?></h5>

             <br/> <br/>
             <div class="container">
              <div class="row">
                <div class="col-lg-6">
                 <h4 class="text-center">Perfil Profissional - ETEC</h4>
                 <p class="text-justify">
                  A Etec Sales Gomes está desenvolvendo um trabalho de identificar o Perfil Profissional de nossos alunos, considerando todo público (alunos do 1º ao 4º Módulo de nossos cursos Técnicos). Para contribuir conosco basta responder o questionário abaixo, aproveitando a ocasião para anexar um curriculo (opcional), que será incluso e atualizado no Banco de Dados da Unidade.
                </p>
                <p class="text-center">
                 <a class="btn btn-primary" target="_blank" href="https://goo.gl/forms/xKqJvzHuzDZYgwYz1"><i class="fa fa-file" aria-hidden="true"> Preencher Perfil</i></a>
               </p>
               <br/>
             </div>

             <div class="col-lg-6">
               <h4 class="text-center">Modelo de Currículo</h4>
               <p class="text-justify">
                Os Professores das disciplinas de Linguagem e Tecnologia da Etec Sales Gomes apresentam em sua grade curricular conteúdos para elaboração de Currículos, que estão em constante observação e alteração conforme necessidades de Mercado. Para auxiliar inicialmente os alunos que ainda não tiveram contato com esta disciplina, divulgo um material que podemos utilizar para elaboração do primeiro currículo ou atualização do que já possuí.
              </p>
              <p class="text-center">
               <a class="btn btn-primary" href="documentos/Modelo_Curriculo.docx"><i class="fa fa-file" aria-hidden="true"> Baixar Modelo</i></a>
             </p>
           </div>
         </div>



         <?php 
            } //fecha foreach
            ?>         
            <?php 
                }//fecha if
                ?>
                <br/>

                <?php  
           /*
           if ($_SESSION['status']=="Administrador") 
           {
            ?>
            <a class="btn btn-primary" href="empresasCadastradas.php">Visualizar Empresas Cadastradas</a>
            <?php 
          }
          */
          ?>
          <br/>
          <p class="text-center">
            <a href="config/login.php" class="btn btn-danger btn-xl"><i class="fa fa-window-close" aria-hidden="true"> Sair</i></a>
            <a href="index.php" class="btn btn-primary btn-xl"><i class="fa fa-arrow-left" aria-hidden="true"> Voltar</i></a>
          </p>
        </div>
      </div>
    </div>
  </section>




  <div class="copyright py-4 text-center text-white">
    <div class="container">
      <a href="http://www.etecsalesgomes.com.br">
        <img src="img/logoEtec.png" width="8%" alt="Etec Sales Gomes">
        <img src="img/cpsbranco.png" width="30%" alt="Etec 50 anos">
      </a>

      <br/><br/>
      <p><em>Site desenvolvido por Gabriel Prestes Américo - Versão Beta 01 - 2020</em></p>
    </div>
  </div>

  <!--####################### MODAL CURRÍCULO  ###################################-->
  <div class="modal fade" id="modalCurriculo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Currículo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div>

           <div class="col-auto">
            <?php 

            ?> 

            <form method="POST" enctype="multipart/form-data" action="config/curriculo.php" acceptcharset="UTF-8"> 
              <p class="text-center">
                <input type="file" id="image" name="image" accept=".pdf" maxlength="5120"/> 

                <div class="alert alert-danger" id="mensagem">O tamanho do arquivo não pode exceder 5 MB!</div>

                <div class="alert alert-primary" id="mensagem2">Anexar em formato .PDF e com tamanho máximo 5 MB!</div>

                <button class="btn btn-primary" type="submit" name="btnenviarCurriculo"> <i class='fa fa-paper-plane' aria-hidden='true'> Enviar</i></button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--##########################################FECHA MODAL CURRICULO ##################################-->


  <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
  <div class="scroll-to-top d-lg-none position-fixed ">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
      <i class="fa fa-chevron-up"></i>
    </a>
  </div>


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


<script>
  //Validação do tamanho do arquivo do currículo a ser anexado
  $("#mensagem").hide();
  var uploadField = document.getElementById("image");

  uploadField.onchange = function() {
    if(this.files[0].size > 5242880)
    {
      //tamanho máximo de 5 MB
      $("#mensagem2").hide();
      $("#mensagem").show("slow");
      this.value = "";
    }
    else
    {
     $("#mensagem").hide("slow");
     $("#mensagem2").show("slow");

   };

 };
</script>

<?php 

}


//caso não tenha valor na variavel, redireciona para index.php
else
{
  echo "<script>window.location = 'index.php'</script>";
  echo "<a href='index.php'>Página Inicial</a>";
}

?>