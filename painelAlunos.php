<?php 
session_start();

//verifica se existe a variavel da sessão
$_SESSION['status'] = isset($_SESSION['status']) ? $_SESSION['status'] : false;

//verifica se tem valor na variavel da sessão
if ($_SESSION['status']=="Admin") 
{
  ?>
  <!DOCTYPE html>
  <html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Painel de Alunos</title>
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
      <h1 class="text-uppercase mb-0">Painel de Alunos</h1>
      <img src="img/icones/icons8-profiles-160.png">
      <h2 class="font-weight-light mb-0">Gerencie o cadastro de Alunos</h2>
    </div>
  </header>



  <!--#################################### SISTEMA DE BUSCA COM AJAX ################################################# -->

  <form class="form-inline float-sm-right">

    <!-- FILTRO 1 -->
    <select class="custom-select mr-sm-2" id="filtro" name="filtro">
      <option value="nomeAluno" selected>Nome</option>
      <option value="idAluno">Código</option>
      <option value="cidade">Cidade</option>
      <option value="curso">Curso</option>
      <option value="periodo">Período</option>
      <option value="idade1">Idade =</option>
      <option value="idade2">Idade >=</option>
      <option value="idade3">Idade <=</option>
      <option value="status1">Status - Pendente</option>
      <option value="status2">Status - Ativo</option>
      <option value="status3">Lista de Exclusões</option>
    </select>


    <!-- FILTRO 2 -->
    <div id="opcoes" style="display:none;">
      <select class="custom-select mr-sm-2" id="filtro2" name="filtro2">     
        <option value="Ensino Médio/ETIM">Ensino Médio/ETIM</option>
        <option value="NovoTec">NovoTec</option>
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
        <option value="Segurança do Trabalho">Segurança do Trabalho</option> 
        <option value="Recursos Humanos">Recursos Humanos</option> 
        <option value="Outro">Outro</option>
      </select>
    </div>

    <input type="text" class="form-control" id="palavra" placeholder="Buscar por...">
    <button class="btn btn-primary" id="buscar" type="button"><i class="fas fa-search" aria-hidden="true"> Buscar</i></button>
    <button class="btn btn-primary" id="todos" type="button"><i class="far fa-list-alt" aria-hidden="true"> Visualizar Todos</i></button>
  </form>


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


  <!-- BOTÃO CADASTRAR ALUNO -->
  <div style="text-align: center">
    <button id="cadAluno" class="btn btn-info" data-toggle="modal" data-target="#modalCadastrar"><i class="far fa-list-alt"></i> Cadastrar Aluno</button>
    <br/><br/>
  </div>
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

    <!-- Contact Form JavaScript 
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>
  -->

  <!-- Custom scripts for this template -->
  <script src="js/freelancer.min.js"></script>

</body>

</html>



<!--################################ MODAL - CADASTRAR ALUNO ####################################################-->
<div class="modal fade" id="modalCadastrar" tabindex="-1" role="dialog" aria-labelledby="modalCadastrar" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ficha de Cadastro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <!--FORMULÁRIO DE CADASTRO-->
        <form id="cadastrarAluno" name="cadastrarAluno" action="javascript:window.actionCadastrar()">

          <div class="form-group">
            <div class="form-row">

              <div class="form-group col-md-6">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
              </div>

              <div class="form-group col-md-3">
                <label for="dataNascimento">Data de Nascimento*</label>
                <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" required>
              </div>

              <div class="form-group col-md-3">
                <label for="cpf">CPF*</label>
                <input type="text" class="form-control" id="cpf" name="cpf" maxlength="14" required placeholder="000.000.000-00" onkeydown="fMasc(this, mCPF);" value="">
              </div>

              <div class="form-group col-md-2">
                <label for="cep">CEP</label>
                <input type="text" class="form-control" id="cep" name="cep" maxlength="9"
                onblur="pesquisacep(this.value);" value="">
              </div>
              <div class="form-group col-md-8">
                <label for="endereco">Endereço</label>
                <input type="text" class="form-control" id="rua" name="rua" value="">
              </div>
              <div class="form-group col-md-2">
                <label for="numero">Número</label>
                <input type="text" class="form-control" id="numero" name="numero" value="">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="bairro">Bairro</label>
                <input type="text" class="form-control" id="bairro" name="bairro" value="">
              </div>
              <div class="form-group col-md-4">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade" value="">
              </div>
              <div class="form-group col-md-2">
               <label for="uf">Estado</label>
               <input type="text" class="form-control" id="uf" name="uf" maxlength="2" value="">
             </div>

             <div class="form-group col-md-6">
               <label for="celular">Celular*</label>
               <input type="text" class="form-control" id="celular" name="celular" required maxlength="14" placeholder="(00)00000-0000" onkeydown="fMasc(this, mTel);" value="">
             </div>

             <div class="form-group col-md-6">
               <label for="contato">Telefone de Contato</label>
               <input type="text" class="form-control" id="contato" name="contato" maxlength="14" placeholder="(00)00000-0000" onkeydown="fMasc(this, mTel);" value="">
             </div>

             <div class="form-group col-md-7">
              <label for="curso">Curso*</label>                
              <select class="form-control" id="curso" name="curso" required>
                <option value="" selected hidden></option>
                <option>Ensino Médio/ETIM</option>
                <option>NovoTec</option>
                <option>Administração</option>
                <option>Desenvolvimento de Sistemas</option>
                <option>Edificações</option>
                <option>Eletrotécnica</option>
                <option>Farmácia</option>
                <option>Informática/Infonet</option>
                <option>Logística</option>
                <option>Manutenção Automotiva</option>
                <option>Mecânica</option>
                <option>Mecatrônica</option>
                <option>Meio Ambiente</option>
                <option>Nutrição e Dietética</option>
                <option>Química</option>
                <option>Segurança do Trabalho</option>
                <option>Recursos Humanos</option>                 
                <option>Outro</option>
              </select>
            </div>

            <div class="form-group col-md-5">
              <label for="periodo">Período</label>
              <select class="form-control" id="periodo" name="periodo" required>
                <option value="" selected hidden></option>
                <option>Integral</option>
                <option>Manhã</option>
                <option>Tarde</option>
                <option>Noite</option>
              </select>
            </div>

            <div class="form-group col-md-6">
             <label for="email">Email Institucional*</label>
             <input type="email" class="form-control" id="email" name="email" required placeholder="@etec.sp.gov.br">
           </div>

             <div class="form-group col-md-6">
                   <label for="emailSecundario">Email Secundario</label>
                   <input type="emailSecundario" class="form-control" id="emailSecundario" name="emailSecundario" placeholder="@EmailPessoal" value="<?php echo $row['emailSecundario'];?>">
                 </div>

           <div class="form-group col-md-6">
             <label for="senha">Senha*</label>
             <input type="password" class="form-control" id="senha" name="senha" required minlength="6" maxlength="15">
           </div>

           <div class="form-group col-md-6">
             <label for="confirmaSenha">Confirmar Senha*</label>
             <input type="password" class="form-control" id="confirmaSenha" name="confirmaSenha" required minlength="6" maxlength="15" onblur="validarSenha();">
           </div>
         </div>
         <!-------------------------------------------------->

         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal" id="fechar" name="fechar"><i class="far fa-times-circle"> Fechar</i></button>
           <button type="submit" name="btnCadastrar" id="btnCadastrar" class="btn btn-primary"><i class="fas fa-save"> Cadastrar</i></button>
         </form>
       </div>
     </div>
   </div>
 </div>
</div>
<!--------------------- FECHA MODAL ----------------------------->


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
            function buscar(palavra, filtro, filtro2)
            {
              var page = "config/alunoBusca_ajax.php";
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
                  filtro2:filtro2
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

                buscar(palavra,filtro, filtro2);
              });

                            //evento click do botão para Listar todos os alunos
                            $('#todos').click(function () {
                              buscar(0,0,0);
                            });
//////////////////////////////////////////////////////////////////////////



  ////////////////////PREENCHER MODAL COM DADOS DO ALUNO /////////////////////////
  function buscarModal(idAluno)
  {
    var page = "config/alunoModal_ajax.php";
    $.ajax
    ({
      type: 'POST',
      dataType: 'html',
      url: page,
      data: {
        idAluno: idAluno
      },
      success: function (msg)
      {
        $("#divModal").html(msg);
        $('#modalAluno').modal('show'); //função para abrir Modal
      }
    });
  }


      ////////////////////////////////////////////////////////////////////////////

            //Função AJAX PARA CADASTRAR OS DADOS DE UM NOVO ALUNO
            function cadastrarAluno(funcao, nomeAluno, dataNascimento, cpf, cep, rua, numero, bairro, cidade, estado, celular, contato, curso, periodo, email, emailSecundario, senha)
            {
              var page = "config/aluno.php";
              $.ajax
              ({
                type: 'POST',
                dataType: 'html',
                url: page,
                data: {
                  funcao : funcao,
                  nomeAluno : nomeAluno,
                  dataNascimento : dataNascimento,
                  cpf : cpf,
                  cep:cep,
                  rua:rua,
                  numero:numero,
                  bairro:bairro,
                  cidade:cidade,
                  estado:estado,
                  celular:celular,
                  contato:contato,
                  curso:curso,
                  periodo:periodo,
                  email:email,
                  emailSecundario:emailSecundario,
                  senha:senha
                },
                success: function (msg)
                {
                  //alert("Cadastrado com Sucesso!");
                  $("#divModal").html(msg);
                  $('#modalCadastrar').modal('toggle'); //fecha modal  
                  buscar(0,0,0);            
                }
              });
            }

             // Pega os valores dos inputs e executa a função cadastrarAluno
             function actionCadastrar()
             {
              var nome = document.getElementById('nome').value;
              var dataNascimento = document.getElementById('dataNascimento').value;
              var cpf = document.getElementById('cpf').value;
              var cep = document.getElementById('cep').value;
              var endereco = document.getElementById('rua').value;
              var numero = document.getElementById('numero').value;
              var bairro = document.getElementById('bairro').value;
              var cidade = document.getElementById('cidade').value;
              var estado = document.getElementById('uf').value;
              var celular = document.getElementById('celular').value;
              var contato = document.getElementById('contato').value;
              var curso = document.getElementById('curso').value;
              var periodo = document.getElementById('periodo').value;
              var email = document.getElementById('email').value;
              var emailSecundario = document.getElementById('emailSecundario').value;
              var senha = document.getElementById('senha').value;


              cadastrarAluno("Cadastrar", nome, dataNascimento, cpf, cep, endereco, numero, bairro, cidade, estado, celular, contato, curso, periodo, email, emailSecundario, senha);


              $('#cadastrarAluno input').val(""); //coloca todos valores de todos inputs do form como vazio

              return false;
            }


          ///////////////////////////////////////////////////////////////

          //executa método assim que carrega a página
           //Fiz isso para listar todos os registros
           $(document).ready(function(){
            buscar(0,0,0);
          });





           //Exiba o elemento filtro após selecionar algo do SELECT
           $("#filtro").change(function() {
            $('opcoes').hide();
            $('palavra').show();

            //se usar o Filtro 2
            if(this.value == "curso")
            {
              $('#opcoes').show();
              $('#palavra').hide();
              $('#palavra').val(""); //limpa input
            }

            if(this.value != "curso")
            {
              $('#opcoes').hide();
              $('#palavra').show();
            }


            //se usar o Filtro do Status Ativo e Pendente
            if((this.value == "status1")||(this.value == "status2")||(this.value == "status3"))
            {
              $('#palavra').hide(); //esconde o input text
            }
            //////////////////////////////////////////////////////////////
          });

        </script>