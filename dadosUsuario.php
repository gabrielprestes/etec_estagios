<?php 
session_start();

include_once "config/config.php"; //incluindo a classe ConexaoBD
$connection = new ConexaoBD();

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

    <title>Conta</title>
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
              <a class="nav-link py-3 px-0 px-lg-3 rounded" href="painelUsuario.php">Painel</a>      
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
      <h1 class="text-uppercase mb-0">Conta</h1>
      <img src="img/icones/icons8-profiles-160.png">
      <h2 class="font-weight-light mb-0">Altere os dados cadastrados</h2>
    </div>
  </header>


  <!--############################## Formulário de Cadastro - ADMINISTRADOR/EMPRESA ###########################--->


  <!-- Se for usuário do Tipo Empresa/Administrador, irá exibir o formulario Abaixo -->
  <?php 
  if ($_SESSION['tipoUsuario']=="Empresa") 
  {

   ?>
   <section id="formularioCadastro">
    <div class="container">
      <h2 class="text-center text-uppercase text-secondary mb-0">Formulário</h2>
      <hr class="mb-5">
      <div class="row">
        <div class="col-lg-8 mx-auto">

          <form action="config/usuario.php" method="POST">
            <h3 style="text-align: center">Dados da Empresa</h3>

            <div class="form-group">
              <div class="form-row">

                <?php 

                /* Pega os dados da empresa com base no ID salvo na Sessão */
                $sql = "SELECT * FROM empresa WHERE idEmpresa=?";     
                $id = array($_SESSION['idUsuario']);
                $resultado = $connection->executar($sql,$id, true);
                ?>

                <div class="row">
                  <?php 
                  foreach ($resultado as $row)
                  {
                    ?>            
                    <!--<div class="form-group col-md-2">
                      <label for="empresa">ID</label>
                      <input type="text" class="form-control" id="idEmpresa" name="idEmpresa" value="<?php echo $row['idEmpresa'];?>" readonly="readonly">
                    </div>-->

                    <div class="form-group col-md-3">
                      <label for="cnpj">Data de Cadastro</label>
                      <input type="text" class="form-control" id="dataCadastro" name="dataCadastro" value="<?php echo $row['dataCadastro'];?>" readonly="readonly">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="empresa">Nome da Empresa*</label>
                      <input type="text" class="form-control" id="empresa" name="empresa" value="<?php echo $row['nomeEmpresa'];?>">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="cnpj">CNPJ*</label>
                      <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="Sem pontos" maxlength="14" value="<?php echo $row['cnpj'];?>" required >
                    </div>

                    <div class="form-group col-md-3">
                      <label for="cep">CEP</label>
                      <input type="text" class="form-control" id="cep" name="cep" maxlength="9" value="<?php echo $row['cep'];?>"
                      onblur="pesquisacep(this.value);">
                    </div>
                    <div class="form-group col-md-7">
                      <label for="rua">Endereço</label>
                      <input type="text" class="form-control" id="rua" name="rua" value="<?php echo $row['endereco'];?>">
                    </div>
                    <div class="form-group col-md-2">
                      <label for="numero">Número</label>
                      <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $row['numero'];?>">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="bairro">Bairro</label>
                      <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo $row['bairro'];?>">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="cidade">Cidade</label>
                      <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $row['cidade'];?>">
                    </div>
                    <div class="form-group col-md-2">
                     <label for="ut">Estado</label>
                     <input type="text" class="form-control" id="uf" name="uf" maxlength="2" value="<?php echo $row['estado'];?>">
                   </div>

                 </div>
               </div>

               <br/>
               <h3 style="text-align: center">Dados do Representante</h3>
               <div class="form-group">
                <div class="form-row">

                  <div class="form-group col-md-5">
                    <label for="nome">Nome*</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $row['nomeRepresentante'];?>" required>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="dataNascimento">Data de Nascimento</label>
                    <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" value="<?php echo $row['dataNascimento'];?>">
                  </div>

                  <div class="form-group col-md-4">
                    <label for="inputCPF">CPF*</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="000.000.000-00" maxlength="14" value="<?php echo $row['cpfRepresentante'];?>" readonly="readonly">

                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="cargo">Cargo</label>
                      <input type="text" class="form-control" id="cargo" name="cargo" value="<?php echo $row['cargoRepresentante'];?>">
                    </div>


                    <div class="form-group col-md-4">
                      <label for="telefone">Telefone Comercial</label>
                      <input type="text" class="form-control" id="telefone" name="telefone"" placeholder="Ex.: (00) 0000-0000" value="<?php echo $row['telefoneRepresentante'];?>">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="celular">Celular*</label>
                      <input type="text" class="form-control" id="celular" name="celular" placeholder="Ex.: (00) 00000-0000" value="<?php echo $row['celularRepresentante'];?>" required>
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="email">Email (Será utilizado como login)</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="@" value="<?php echo $row['emailRepresentante'];?>" required>
                  </div>

                  <div class="form-group col-md-6">
                   <label class="form-check-label" for="checkSenha">Alterar Senha</label>
                   <input type="checkbox" class="form-check form-check-inline" id="checkSenha" onclick="verificaCheck();">
                   <!--<input type="password" class="form-control" id="senha" name="senha" value="<?php echo $row['senhaRepresentante'];?>" required minlength="6" maxlength="15">-->
                   <input type="password" class="form-control" id="senha" name="senha" required minlength="6" maxlength="15" disabled>
                 </div>
               </div>
             </div>
           </div>         

           <div style="text-align: center">
             <button type="submit" class="btn btn-primary btn-lg" name="btnAlterarEmpresa"><i class="fas fa-save">Alterar</i></button>  
             <a href="painelUsuario.php" class="btn btn-primary btn-lg"><i class="fa fa-arrow-left" aria-hidden="true">Voltar</i></a>
           </div>
         </form>


       </div>
     </div>
   </div>
 </section>

 <?php 
}
}
?>
<!--------------------------------------------------------------------------------------------->



<!--############################## Formulário de Cadastro - ALUNO #####################################-->
<?php 

if ($_SESSION['tipoUsuario']=="Aluno") 
{
 ?>

 <section id="formularioCadastro">
  <div class="container">
    <h2 class="text-center text-uppercase text-secondary mb-0">Formulário de Cadastro</h2>
    <hr class="mb-5">
    <div class="row">
      <div class="col-lg-8 mx-auto">

        <form action="config/usuario.php" method="POST">
          <h3 style="text-align: center">Dados do Cadastro</h3>

          <div class="form-group">
            <div class="form-row">

              <?php 

              /* Pega os dados com base no ID salvo na Sessão */
              $sql = "SELECT * FROM aluno WHERE idAluno=?";     
              $id = array($_SESSION['idUsuario']);
              $resultado = $connection->executar($sql,$id,true);
              ?>

              <div class="row">
                <?php 
                foreach ($resultado as $row)
                {
                  ?>            
                  <!--<div class="form-group col-md-2">
                    <label for="idAluno">ID</label>
                    <input type="text" class="form-control" id="idAluno" name="idAluno" value="<?php echo $row['idAluno'];?>" disabled>
                  </div>-->


                  <div class="form-group col-md-5">
                    <label for="nome">Nome*</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $row['nomeAluno'];?>">
                  </div>

                  <div class="form-group col-md-4">
                    <label for="dataNascimento">Data de Nascimento</label>
                    <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" value="<?php echo $row['dataNascimento']; ?>">
                  </div>

                  <div class="form-group col-md-3">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="000.000.000-00" required maxlength="14" value="<?php echo $row['cpf'];?>" required readonly>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="cep">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep" maxlength="9" value="<?php echo $row['cep'];?>"
                    onblur="pesquisacep(this.value);">
                  </div>
                  <div class="form-group col-md-7">
                    <label for="rua">Endereço</label>
                    <input type="text" class="form-control" id="rua" name="rua" value="<?php echo $row['endereco'];?>">
                  </div>
                  <div class="form-group col-md-2">
                    <label for="numero">Número</label>
                    <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $row['numero'];?>">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="bairro">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo $row['bairro'];?>">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="cidade">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $row['cidade'];?>">
                  </div>
                  <div class="form-group col-md-2">
                   <label for="ut">Estado</label>
                   <input type="text" class="form-control" id="uf" name="uf" maxlength="2" value="<?php echo $row['estado'];?>">
                 </div>

                 <div class="form-group col-md-4">
                  <label for="celular">Celular</label>
                  <input type="text" class="form-control" id="celular" name="celular" required maxlength="14" placeholder="Ex.: (00) 00000-0000" value="<?php echo $row['celular'];?>" onkeydown="fMasc(this, mTel);">
                </div>

                

                <div class="form-group col-md-4">
                  <label for="contato">Contato</label>
                  <input type="text" class="form-control" id="contato" name="contato" placeholder="Ex.: (00) 0000-0000" value="<?php echo $row['contato'];?>" onkeydown="fMasc(this, mTel);" maxlength="14">
                </div>

                <div class="form-group col-md-7">
                  <label for="curso">Curso</label>
                  <select class="form-control" id="curso" name="curso" required>
                    <option value="<?php echo $row['curso'];?>" selected hidden><?php echo $row['curso'];?></option>
                    <option>Ensino Médio</option>
                    <option>Informática/Desenvolvimento de Software</option>
                    <option>Nutrição</option>
                    <option>Administração</option>
                    <option>Mecânica</option>
                    <option>Meio Ambiente</option>
                    <option>Outro</option>
                  </select>
                </div>

                <div class="form-group col-md-5">
                  <label for="periodo">Período</label>
                  <select class="form-control" id="periodo" name="periodo" required>
                    <option value="<?php echo $row['periodo'];?>" selected hidden><?php echo $row['periodo'];?></option>
                    <option>Integral</option>
                    <option>Manhã</option>
                    <option>Tarde</option>
                    <option>Noite</option>
                  </select>
                </div>

                <div class="form-group col-md-6">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['emailAluno'];?>" disabled>
                </div>

                <div class="form-group col-md-6">
                  <label class="form-check-label" for="checkSenha">Alterar Senha</label>
                   <input type="checkbox" class="form-check form-check-inline" id="checkSenha" onclick="verificaCheck();">
                  <!--<input type="password" class="form-control" id="senha" name="senha" value="<?php echo $row['senhaAluno'];?>" required>-->
                   <input type="password" class="form-control" id="senha" name="senha" required minlength="6" maxlength="15" disabled>

                </div>


                


              </div>

              <div style="text-align: center">
               <button type="submit" class="btn btn-primary btn-lg" name="btnAlterarAluno"><i class="fas fa-save"> Salvar Alterações</i></button>  
               <a href="painelUsuario.php" class="btn btn-primary btn-lg"><i class="fa fa-arrow-left" aria-hidden="true">Voltar</i></a>
             </div>

           </form>
         </div>
       </div>
     </div>
   </section>

   <?php 
 }

}

?>
<!--------------------------------------------------------------------------------------------->



<!-- Footer -->
<footer>
  <div class="copyright py-4 text-center text-white">
    <div class="container">
      <a href="http://www.etecsalesgomes.com.br">
        <img src="img/logoEtec.png" width="8%" alt="Etec Sales Gomes">
        <img src="img/cpsbranco.png" width="30%" alt="Etec 50 anos">
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

<script src="js/apiCEP.js"></script> <!-- API para retornar o endereço através do CEP -->
<script src="js/inputMask.js"></script> <!-- Validação no campo email e senha, Mascára nos inputs text de cpf, telefone-->

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

<!-- Custom scripts for this template -->
<script src="js/freelancer.min.js"></script>

<script>
                  //verifica se irá alterar a senha ou não
                  function verificaCheck()
                  {
                    var checkBox = document.getElementById("checkSenha");
                    if (checkBox.checked == true)
                    {
                      document.getElementById('senha').disabled = 0;
                      //document.getElementById('senha').value = "";
                    }
                    else
                    {
                     document.getElementById('senha').disabled = 1;
                     document.getElementById('senha').value = "";

                   }
                 }
               </script>

             </body>

             </html>



             <?php
} //fecha if da variavél da sessão

//caso não tenha valor na variavel, redireciona para index.php
else
{
  echo "<script>window.location = 'index.php'</script>";
  echo "<a href='index.php'>Página Inicial</a>";
}

?>
