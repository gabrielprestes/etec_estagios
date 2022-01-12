<?php 
session_start();

//verifica se existe a variavel da sessão
$_SESSION['tipoUsuario'] = isset($_SESSION['tipoUsuario']) ? $_SESSION['tipoUsuario'] : false;

//verifica se tem valor na variavel da sessão
//if ($_SESSION['status']=="Admin") 
if (($_SESSION['tipoUsuario']=='Empresa') || ($_SESSION['tipoUsuario']=='Aluno'))
{
  ?>
  <!DOCTYPE html>
  <html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Painel de Inscrições</title>
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

    <!------------------ JS ------------------------>
    <script src="js/apiCEP.js"></script> <!-- API para retornar o endereço através do CEP -->
    <script src="js/inputMask.js"></script> <!-- Validação no campo email e senha, Mascára nos inputs text de cpf, telefone-->
    <!---------------------------------------------->
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
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php">Página Inicial</a>
            </li>


            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="painelUsuario.php">Painel</a>
            </li>

            <!-- Sair 
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="config/login.php">Sair</a>      
            </li>
          -->
        </ul>
      </div>
    </div>
  </nav>
  <br/>
  <!-- Header -->
  <header class="masthead bg-primary text-white text-center">
    <div class="container">
      <h1 class="text-uppercase mb-0">Painel de Inscrições</h1>
      <img src="img/icones/icons8-profiles-160.png">
      <h2 class="font-weight-light mb-0">Gerencie o cadastro de Inscrições</h2>
    </div>
  </header>




  <?php 
  if ($_SESSION['tipoUsuario']=='Empresa') 
  {
   ?>
   
   <!--#################################### SISTEMA DE BUSCA COM AJAX - ADMIN ############################################ -->

   <form class="form-inline float-sm-right">

    <!-- FILTRO 1 -->
    <select class="custom-select mr-sm-2" id="filtro" name="filtro">
      <option value="idInscricao">Id - Inscrição</option>
      <option value="dataInscricao">Mês da Inscrição</option>
      <option value="idAluno">Id - Aluno</option>
      <option value="nomeAluno" selected>Nome - Aluno</option>
      <option value="curso">Curso - Aluno</option>
      <option value="cidade">Cidade - Aluno</option>
      <option value="idVaga">Id - Vaga</option>
      <option value="titulo">Título da Vaga</option>
      <option value="status3">Lista de Exclusões</option>
    </select>


    <!-- FILTRO 2 -->
    <div id="opcoes" style="display:none;">
      <select class="custom-select mr-sm-2" id="filtro2" name="filtro2">     
        <option value="Ensino Médio/ETIM">Ensino Médio/ETIM</option>
        <option value="Administração">Administração</option>
        <option value="Desenvolvimento de Sistemas">Desenvolvimento de Sistemas</option>
        <option value="Edificações">Edificações</option>
        <option value="Eletrotécnica">Eletrotécnica</option>
        <option value="Farmácia">Farmácia</option>
        <option value="Informática/Infonet">Informática/Infonet</option>
        <option value="Logística">Logística</option>
        <option value="Manutenção Automotiva">Manutenção Automotiva</option>
        <option value="Mecânica">Mecânica</option>
        <option value="Mecatrônica">Mecatrônica</option>
        <option value="Meio Ambiente">Meio Ambiente</option>
        <option value="Nutrição e Dietética">Nutrição e Dietética</option>
        <option value="Química">Química</option>      
        <option value="Outro">Outro</option>
      </select>
    </div>



    <!-- FILTRO 3 - MÊS -->
    <input type="month" class="form-control" id="filtro3" name="filtro3" min="2020-06" value="2020-06" style="display:none;">
    
    <!--
    <div id="opcoes" style="display:none;">
      <select class="custom-select mr-sm-2" id="filtro3" name="filtro3">     
        <option value="1">Janeiro</option>
        <option value="2">Fevereiro</option>
        <option value="3">Março</option>
        <option value="4">Abril</option>
        <option value="5">Maio</option>
        <option value="6">Junho</option>
        <option value="7">Julho</option>
        <option value="8">Agosto</option>
        <option value="9">Setembro</option>
        <option value="10">Outubro</option>
        <option value="11">Novembro</option>
        <option value="12">Dezembro</option>
      </select>
    -->
    </div>


    <input type="text" class="form-control" id="palavra" placeholder="Buscar por...">
    <button class="btn btn-primary" id="buscar" type="button"><i class="fas fa-search" aria-hidden="true"> Buscar</i></button>
    <button class="btn btn-primary" id="todos" type="button"><i class="far fa-list-alt" aria-hidden="true"> Visualizar Todos</i></button>
  </form>
  <?php 
} //fecha valida tipoUsuario = Empresa
?>
<!--#################################### DIV PARA RETORNAR DADOS DA BUSCA ################################################# -->
<div id="dados">
  <!-- Aqui aparecerá os dados buscados... Retorna a tabela de valores cadastrados -->

</div> <!-- FECHA A DIV DO "DADOS" -->

<!----------------------------------------------------------------------------------------------------------->


<!--#################################### DIV MODAL ################################################# -->
<div id="divModal">
  <!-- Fiz esta div para o MODAL poder ser aberto corretamente -->
</div>
<!----------------------------------------------------------------------------------------------------------->

<!---------------------------->

<div style="text-align: right">
  <a href="painelUsuario.php" class="btn btn-primary btn-lg"><i class="fa fa-arrow-left" aria-hidden="true">Voltar</i></a>
</div>
<!-- Footer -->
<footer>
  <div class="copyright py-4 text-center text-white">
    <div class="container">
      <a href="http://www.etecsalesgomes.com.br">
        <img src="img/logoEtec.png" width="8%" alt="Etec Sales Gomes">
        <img src="http://www.etecsalesgomes.com.br/imagens/cpsbranco.png" width="30%" alt="Etec 50 anos">
      </a>
    </div>
  </div>
</footer>

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


<?php
} //fecha if da variavel da sessão

//caso não tenha valor na variavel, redireciona para index.php
else
{
  echo "<script>window.location = 'index.php'</script>";
  echo "<a href='index.php'>Página Inicial</a>";
}
?>



<!--################################## SCRIPTS DA PÁGINA ############################### -->

<script>
//////////////////// FUNÇÃO DE BUSCA COM FILTROS /////////////////////////

            //FUNÇÃO AJAX PARA BUSCAR CONTEÚDO
            function buscar(palavra, filtro, filtro2, filtro3)
            {
              var page = "config/inscricaoBusca_ajax.php";
              $.ajax
              ({
                type: 'POST',
                dataType: 'html',
                url: page,
                beforeSend: function () {
                  $("#dados").html("Carregando...");
                },
                data: {palavra: palavra,
                  filtro:filtro,
                  filtro2:filtro2,
                  filtro3:filtro3
                },
                success: function (msg)
                {
                  $("#dados").html(msg);
                }
              });
            }


////////////////////EVENTOS DE BOTÃO /////////////////////////
              //evento click do botão Buscar
              $('#buscar').click(function () {
                var palavra = $("#palavra").val();
                var filtro = $("#filtro").val();
                var filtro2 = $("#filtro2").val();
                var filtro3 = $("#filtro3").val();

                buscar(palavra,filtro, filtro2, filtro3);
              });

                            //evento click do botão para Listar todos os alunos
                            $('#todos').click(function () {
                              buscar(0,0,0,0);
                            });
//////////////////////////////////////////////////////////////////////////



////////////////////PREENCHER MODAL COM DADOS DO INSCRIÇÃ0 (Vaga e Aluno) /////////////////////////
function buscarModal(idInscricao)
{
  var page = "config/inscricaoModal_ajax.php";
  $.ajax
  ({
    type: 'POST',
    dataType: 'html',
    url: page,
    data: {
      idInscricao: idInscricao
    },
    success: function (msg)
    {
      $("#divModal").html(msg);
        $('#modalInscricao').modal('show'); //função para abrir Modal
      }
    });
}

            ///////////////////////////////////////////////////////////////

           //Função AJAX PARA ATIVAR o CADASTRO
            //Vou usar para Ativar, desativar, excluir
            function alterarStatus(id,funcao)
            {
              var page = "config/inscricao.php";
              $.ajax
              ({
                type: 'POST',
                dataType: 'html',
                url: page,
                data: {
                  id: id,
                  funcao : funcao
                },
                success: function (msg)
                {


                  if(funcao=="Excluir")
                  {
                   alert("Excluido com sucesso!");  
                 }

                 buscar(0,0,0,0);
           //////////////
         }
       });
            }


          ///////////////////////////////////////////////////////////////

          //executa método assim que carrega a página
           //Fiz isso para listar todos os registros
           $(document).ready(function(){
            buscar(0,0,0,0);
          });



           //Exiba o elemento filtro após selecionar algo do SELECT
           $("#filtro").change(function() {
            $('opcoes').hide();
            $('palavra').show();
            $('#filtro3').hide();

            //se usar o Filtro 2
            if(this.value == "curso")
            {
              $('#opcoes').show();
              $('#palavra').hide();
              $('#palavra').val(""); //limpa input
              $('#filtro3').hide();
            }

            if(this.value != "curso")
            {
              $('#opcoes').hide();
              $('#palavra').show();
              $('#filtro3').hide();
            }

            if(this.value == "dataInscricao")
            {
              $('#opcoes').hide();
              $('#palavra').hide();
              $('#filtro3').show();
            }


            //se usar o Filtro do Status Ativo e Pendente
            if((this.value == "status1")||(this.value == "status3"))
            {
              $('#palavra').hide(); //esconde o input text
            }
            //////////////////////////////////////////////////////////////
          });

        </script>