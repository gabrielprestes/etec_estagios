<?php 
session_start();

//verifica se tem valor na variavel da sessão
if (empty($_SESSION['idUsuario']))
{
  ?>

  <!DOCTYPE html>
  <html lang="pt-br">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Gabriel">

    <title>ETEC Sales Gomes - Formulário</title>
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
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php">Página Inicial</a>
            </li>


          </ul>
        </div>
      </div>
    </nav>


    <!-- Header -->
    <header class="masthead bg-primary text-white text-center">
      <div class="container">
        <h1 class="text-uppercase mb-0">Cadastro - Aluno</h1>
        <img src="img/icones/icons8-student.png">
        <h2 class="font-weight-light mb-0">Preencha o Formulário de Cadastro</h2>
      </div>
    </header>


    <!------------------------ Formulário de Cadastro ------------------------------------------------>
    <!-- Este formulário utiliza os arquivos JS: apiCEP e inputMask em alguns campos -->
    <section id="formularioCadastro">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Formulário de Cadastro</h2>
        <hr class="mb-5">
        <div class="row">
          <div class="col-lg-8 mx-auto">

            <form action="config/usuario.php" method="POST">
              <h3 style="text-align: center">Dados Pessoais</h3>

              <div class="form-group">
                <div class="form-row">

                  <div class="form-group col-md-5">
                    <label for="aluno">Nome Completo*</label>
                    <input type="text" class="form-control" id="aluno" name="aluno" required>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="dataNascimento">Data de Nascimento</label>
                    <input type="date" class="form-control" id="dataNascimento" name="dataNascimento">
                  </div>

                  <div class="form-group col-md-4">
                    <label for="cpf">CPF*</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" maxlength="14" required placeholder="000.000.000-00" onkeydown="fMasc(this, mCPF);">
                  </div>

                  <div class="form-group col-md-2">
                    <label for="cep">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep" maxlength="9"
                    onblur="pesquisacep(this.value);">
                  </div>
                  <div class="form-group col-md-8">
                    <label for="rua">Endereço</label>
                    <input type="text" class="form-control" id="rua" name="rua">
                  </div>
                  <div class="form-group col-md-2">
                    <label for="numero">Número</label>
                    <input type="text" class="form-control" id="numero" name="numero">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="bairro">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="cidade">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade">
                  </div>
                  <div class="form-group col-md-2">
                   <label for="uf">Estado</label>
                   <input type="text" class="form-control" id="uf" name="uf" maxlength="2">
                 </div>

                 <div class="form-group col-md-6">
                   <label for="celular">Celular*</label>
                   <input type="text" class="form-control" id="celular" name="celular" required maxlength="14" placeholder="(00)00000-0000" onkeydown="fMasc(this, mTel);">
                 </div>

                 <div class="form-group col-md-6">
                   <label for="contato">Telefone de Contato</label>
                   <input type="text" class="form-control" id="contato" name="contato" maxlength="14" placeholder="(00)00000-0000" onkeydown="fMasc(this, mTel);">
                 </div>

                 <div class="form-group col-md-7">
                  <label for="curso">Curso</label>
                  <select class="form-control" id="curso" name="curso" required>
                    <option value="" selected disabled hidden>Selecionar Curso</option>
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
                    <option value="" selected disabled hidden>Selecionar Período</option>
                    <option>Integral</option>
                    <option>Manhã</option>
                    <option>Tarde</option>
                    <option>Noite</option>
                  </select>
                </div>


                <div class="form-group col-md-7">
                 <label for="email">Email Institucional*</label>
                 <input type="email" class="form-control" id="email" name="email" required onblur="validarEmail();" placeholder="@etec.sp.gov.br">
               </div>

                <div class="form-group col-md-5">
                 <label for="email">Email Secundário</label>
                 <input type="email" class="form-control" id="emailSecundario" name="emailSecundario" placeholder="@emailPessoal">
               </div>

               <div class="form-group col-md-6">
                 <label for="senha">Senha*</label>
                 <input type="password" class="form-control" id="senha" name="senha" required minlength="6" maxlength="12" placeholder="Mínimo 6 Caracteres">
               </div>

               <div class="form-group col-md-6">
                 <label for="confirmaSenha">Confirmar Senha*</label>
                 <input type="password" class="form-control" id="confirmaSenha" name="confirmaSenha" required onblur="validarSenha();" minlength="6">
               </div>
             </div>
             <br/>

             <div style="text-align: center">
              <a class="btn btn-primary" data-toggle="modal" data-target="#modalTermos" href="">Termos de Uso</a><br/><br/>
              <button type="submit" class="btn btn btn-success btn-xl" name="btnCadastrarAluno">Cadastrar</button>
              <p>Ao clicar em "Cadastrar" você aceita os termos de uso da plataforma</p>
            </div>
            <div style="text-align: right">
              <a href="index.php" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"> Voltar</i></a>  
            </div>

          </form>
        </div>
      </div>
    </div>
  </section>
  <!--------------------------------------------------------------------------------------------->


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

              Esqueceu a senha?

              <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>-->
            </div>              
          </form>
        </div>
      </div>
    </div>
  </div>
</form>
</div>


<!-- FECHA LOGIN -->

<!-- Modal Termos de Uso-->
<div class="modal fade" id="modalTermos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Termos de Uso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <h4>Informações que coletamos</h4>
        <p style="text-align: justify; font-size: 15px;">
          <b>Dados de Cadastro:</b>
          Quando você se cadastra no ETEC Estágos, você nos fornece informações como Nome Completo, Data de Nascimento, CPF, Endereço, Celular, Curso, Período, Email Institucional e Senha.
        </p>

        <h4>Como Usamos usas informações:</h4>

        <p style="text-align: justify; font-size: 15px;">
          Não custa lembrar que prezamos pela sua privacidade, por isso, todos os dados e informações pessoais são tratadas como confidenciais, e somente usaremos para os fins aqui descritos e autorizados por você, principalmente para que voce possa utilizar o ETEC Estágios de forma plena, visando sempre melhorar a experência como usuário:
        </p>

        <h4>Usos Autorizados</h4>
        <p style="text-align: justify; font-size: 15px;">
          <ul class="list-group">
            <li>Permitir que você e utilize todas as funcionalidades do ETEC Estágios;</li>
            <li>Enviar a você mensagens a respeito de suporte ou serviço, como alertas, notificações e atualizações;</li>
            <li>Nos comunicar com você sobre serviços, promoções, notícias, atualizações, eventos e outros assuntos;</li>
            <li>Analise o tráfego dos usuáros em nossas aplicações;</li>
            <li>Verificar e/ou autenticar as informações fornecidas por você, inclusive comparando a dados coletados de outras fontes;</li>
            <li>Para qualquer fim que você autorizar no momento da coleta de dados;</li>
          </ul>
        </p>

        <h4>Segurança das Informações</h4>
        <p style="text-align: justify; font-size: 15px;">Todos os seus dados são confidenciais e somente as pessoas com as devidas autorizações terão acesso a eles. Qualquer uso destes estará de acordo com a presente Política. O ETEC Estágios empreenderá todos os esforços razoáveis de mercado para garantir a segurança dos nossos sistemas e dos seus dados.</p>
        <p style="text-align: justify; font-size: 15px;">Todas as suas informações serão, sempre que possível, criptografadas, caso não inviabilizem o seu uso pela plataforma.</p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>


<!------------------ JS ------------------------>
<script src="js/apiCEP.js"></script> <!-- API para retornar o endereço através do CEP -->
<script src="js/inputMask.js"></script> <!-- Validação no campo email e senha, Mascára nos inputs text de cpf, telefone-->
<!---------------------------------------------->



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
}


//caso não tenha valor na variavel na Sessão, redireciona para index.php
else
{
  echo "<script>window.location = 'index.php'</script>";
  echo "<a href='index.php'>Página Inicial</a>";
}



?>
