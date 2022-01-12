<?php 
session_start();
include_once "config.php"; //incluindo a classe ConexaoBD
$connection = new ConexaoBD();

//na próxima versão, fazer utilizando o arquivo INIT.php
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Login</title>
	<link rel="shortcut icon" href="../img/favicon.ico"/>

	<!-- Bootstrap core CSS -->
	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="../css/freelancer.min.css" rel="stylesheet">

	<!-- Bootstrap core JavaScript -->
	<script src="../vendor/jquery/jquery.min.js"></script>
	
	<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<style type="text/css">
		.flex-box {
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.container-box {
			height: 50%;
		}

		.content-box {
			
			text-align: center;
			width: 100%;
		}

		body
		{
			background-color: #a3130d !important;
		}
	</style>

	<script>
		//redireciona página
		function redireciona(link)
		{
			setTimeout(function()
			{ 
				window.location = '../'+link; 
			}, 1050);
		}
	</script>

</head>
<body>

	<?php
// as variáveis login e senha recebem os dados digitados na página anterior
	if (isset($_POST['btnLogar'])) 
	{
		$email = $_POST['email'];
		$senha = md5(sha1($_POST['senha']));
		$dados= array($email, $senha);

	$_SESSION['tipoUsuario'] = NULL; //irá definir se será Empresa(administrador) ou aluno, começa no NULL para cair na primeira condição

	try
	{
		//PRIMEIRO VERIFICA SE O USUÁRIO É ALUNO
		/*###################################### USUÁRIO ALUNO ######################################*/
		if ($_SESSION['tipoUsuario'] == NULL)
		{
			$sql = "SELECT * FROM aluno WHERE emailAluno=? AND senhaAluno=? AND NOT status='Inativo'";
			$resultado = $connection->executar($sql,$dados,true);

		/* 	count = número de registros encontrados
		Verifica se a variável $resultado encontrou apenas 1 registro, atribuirá valores na variavel da sessão e redirecionará para a página do painel do usuário. Caso não encontre, irá fazer a próxima condição */
		if(count($resultado) == 1)
		{
			foreach ($resultado as $row)
			{
				$_SESSION['idUsuario'] = $row['idAluno'];
				$_SESSION['nomeUsuario'] = $row['nomeAluno'];
				$_SESSION['email'] = $row['emailAluno'];
				$_SESSION['status'] = $row['status'];
				$_SESSION['curriculo'] = $row['curriculo'];

				$_SESSION['tipoUsuario']="Aluno";
			}
			?>
			<div class="flex-box container-box">
				<div class="content-box">
					<div class="alert alert-success" id="saveAlert" ><h1>Login de Aluno efetuado com Sucesso!</h1><br/><h2>Acesse o <a href='../painelUsuario.php'>Painel do Usuário</a></h2></div>
				</div>
			</div>

			<script>
				redireciona("painelUsuario.php");
			</script>
			<?php 
		}
	}

	/*#############################################################################*/

	//Caso a primeira condição não seja válidad, verifica esta condição, que no caso é administrador
	/*#####################USUÁRIO EMPRESA/ADMINISTRADOR######################################*/
	if ($_SESSION['tipoUsuario']!="Aluno")
	{

		$sql = "SELECT * FROM empresa WHERE emailRepresentante=? AND senhaRepresentante=? AND NOT status='Inativo'";
		$resultado = $connection->executar($sql,$dados,true);

		/* 	count = número de registros encontrados
		Verifica se a variável $resultado encontrou apenas 1 registro, atribuirá valores na variavel da sessão e redirecionará para a página do painel do usuário. Caso não encontre, retornara para a página de erro para tentar novamente realizar o login */
		
		if(count($resultado) == 1)
		{
			foreach ($resultado as $row)
			{
				$_SESSION['idUsuario'] = $row['idEmpresa'];
				$_SESSION['nomeUsuario'] = $row['nomeRepresentante'];
				$_SESSION['email'] = $row['emailRepresentante'];
				$_SESSION['status'] = $row['status'];

				$_SESSION['tipoUsuario']="Empresa";
			}
			?>
			<div class="flex-box container-box">
				<div class="content-box">
					<div class="alert alert-success" id="saveAlert" ><h1>Login efetuado com Sucesso!</h1><br/><h2>Acesse o <a href='../painelUsuario.php'>Painel do Usuário</a></h2></div>
				</div>
			</div>

			<script>
				redireciona("painelUsuario.php");
			</script>

			<?php 
		}

		else
		{
			?>
			<div class="flex-box container-box">
				<div class="content-box">
					<div class="alert alert-danger" id="saveAlert" ><h1>Dados Inválidos!</h1><br/><h2>Acessar a <a href='../index.php'>Página Inicial</a></h2></div>
				</div>
			</div>

			<script>
				redireciona("index.php");
			</script>
			<?php 
		}	
	}

	/*###########################################################################################*/
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
} //fecha if do isset


//caso as condições não sejam válidas, finaliza a sessão
else
{
	//header("Refresh: 2;url=../index.php"); 
	unset ($_SESSION['email']);
	unset ($_SESSION['senha']);
	unset ($_SESSION['idUsuario']);
	//Apagando todos os dados da sessão:
	session_unset();
	session_destroy();
	?>

	<div class="flex-box container-box">
		<div class="content-box">
			<div class="alert alert-warning" id="saveAlert" ><h1>Você será redirecionado para a </h1><h2><a href='../index.php'>Página Inicial</a></h2></div>
		</div>
	</div>
	<script>
		redireciona("index.php");
	</script>
	<?php 
}
?>


<script>
	//efeitos para exibir a mensagem do ALERT
	$("#saveAlert").hide();
	$("#saveAlert").show("slow");
</script>

</body>
</html>


