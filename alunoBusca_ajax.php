<?php
session_start();
include_once "config.php"; //incluindo a classe ConexaoBD
$connection = new ConexaoBD();


// VERIFICA SE USUÁRIO É ADMINISTRADOR
if ($_SESSION['tipoUsuario']!="Aluno")
{

  $palavra = isset($_POST["palavra"] ) ? $_POST["palavra"] : false;  //texto do select
  $filtro = isset($_POST["filtro"] ) ? $_POST["filtro"] : false;  //Filtro 1
  $filtro2 = isset($_POST["filtro2"] ) ? $_POST["filtro2"] : false;  //Filtro 2 - da lista de cursos
  $status = "Inativo";


########################### SELEÇÃO DE FILTROS ###########################

//Tive problemas para trabalhar com parametros na clausula SQL, então fiz por IF mesmo por enquanto

  if(($filtro=="nomeAluno")||($filtro=="cidade")||($filtro=="periodo"))
  {
    $sql = "SELECT * FROM aluno WHERE ".$filtro." LIKE '%$palavra%' AND status<>?";
    $dados = array($status);
  }

  else if($filtro=="idAluno")
  {
    $sql = "SELECT * FROM aluno WHERE idAluno = ? AND status<>?";
    $dados = array($palavra, $status); 
  }


//Curso escolhido no filtro 2
  else if($filtro=="curso")
  {
   $sql = "SELECT * FROM aluno WHERE curso = ? AND status<>?";
   $dados = array($filtro2, $status);  
 }


//idade =
  else if($filtro=="idade1")
  {
   $sql = "SELECT * FROM aluno WHERE YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dataNascimento)))=? AND status<>?";
   $dados = array($palavra, $status); 
 }

 //idade >=
  else if($filtro=="idade2")
  {
   $sql = "SELECT * FROM aluno WHERE YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dataNascimento)))>=? AND status<>?";
   $dados = array($palavra, $status); 
 }

 //idade <=
  else if($filtro=="idade3")
  {
   $sql = "SELECT * FROM aluno WHERE YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dataNascimento)))<=? AND status<>?";
   $dados = array($palavra, $status); 
 }


//pendente
 else if($filtro=="status1")
 {
   $sql = "SELECT * FROM aluno WHERE status = 'Pendente'";
   $dados = array();   
 }


//ativo
 else if($filtro=="status2")
 {
   $sql = "SELECT * FROM aluno WHERE status = 'Ativo'";
   $dados = array();   
 }

  else if($filtro=="status3")
 {
   $sql = "SELECT * FROM aluno WHERE status = 'Inativo'";
   $dados = array();   
 }

//lista todos
 else
 {
  $sql = "SELECT * FROM aluno WHERE status<>'Inativo' ORDER BY nomeAluno";
  $dados = array(); 
}

  //############################### Listagem de Vagas em Forma de Tabela #################################-->
try
{
  $resultado = $connection->executar($sql,$dados,true);

  ?>
  <table class="table table-hover table-striped table-responsive-lg">
    <!-- Cabeçalho  da Tabela -->
    <thead class="thead-dark">
      <th scope="row">Id</th>
      <th scope="row">Nome</th>
      <th scope="row">Cidade</th>
      <th scope="row">Celular</th>
      <th scope="row">Curso</th>
      <th scope="row">Período</th>
      <th scope="row">Currículo</th>
      <th scope="row">Status</th>
      <th scope="row">Opções</th>
    </thead>

    <?php 
      if(count($resultado)>0) //conta a quantidade de registros da consulta
      {
          //Percorre os valores e exibe na tabela
        foreach ($resultado as $row)
        {
          ?>
          <form method="POST" action="config/aluno.php">
            <tr>
              <!-- Exibe os campos da tabela -->
              <input type="hidden" name="idAluno" value="<?php echo $row['idAluno']; ?>"> <!-- utilizei o hidden para jogar o id para outra página via POST-->
              
              <td><?php echo $row['idAluno']; ?></td>
              <td><?php echo $row['nomeAluno']; ?></td>
              <td><?php echo $row['cidade']; ?></td>
              <td><?php echo $row['celular']; ?></td>
              <td><?php echo $row['curso']; ?></td>
              <td><?php echo $row['periodo']; ?></td>
              <?php 
              //Verificação se tem curriculo anexado
              if ($row['curriculo']==NULL)
              {
                echo "<td><b>Não anexado</b></td>";
              }
              else
              {
               ?>
               <td><a href="curriculos/<?php echo $row['curriculo'];?>" download><i class="fa fa-file" aria-hidden="true"> Baixar Currículo</i></a></td><?php } ?>
               <td><?php echo $row['status'];?></td>
               <td>
                 
                 <?php
             ############CONDIÇÃO PARA EXIBIR BOTÃO 'ATIVAR' OU 'DESATIVAR' ##############
                 if ($row['status']=="Ativo") 
                 {
                  ?>
                  <button id="<?php echo $row['idAluno'];?>" class="btn btn-primary" onClick="alterarStatus(this.id,'Desativar');" data-toggle="tooltip" data-placement="top" title="Desativar"><i class="fas fa-lock"></i></button>  
                  <?php 
                }
                else
                {
                  ?>
                  <button id="<?php echo $row['idAluno'];?>" class="btn btn-warning" onClick="alterarStatus(this.id,'Ativar');" data-toggle="tooltip" data-placement="top" title="Ativar"><i class="fas fa-unlock"></i></button>  
                  <?php 
                } 
            ############################### fecha condição #############################
                ?>

                <button id="<?php echo $row['idAluno'];?>" class="btn btn-danger" onClick="alterarStatus(this.id,'Excluir');" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="fas fa-trash-alt"></i></button>

                <button id="<?php echo $row['idAluno'];?>" class="btn btn-info" onClick="
                 buscarModal(this.id);" data-toggle="tooltip" data-placement="top" title="Visualizar Dados"><i class="far fa-list-alt"></i></button>
               </td>
             </tr>
           </form>            
           <?php 
          } //fecha foreach
        } //fecha if do COUNT

        else
        {
          echo "<h4>Nao foram encontrados registros!</h4>";
        }
        ?>
      </table>
      <?php 
      } // tray
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }
      ?>
      <!--########################################################################################--> 

      <script>


$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

          //Função AJAX PARA ATIVAR o CADASTRO
            //Vou usar para Ativar, desativar, excluir
            function alterarStatus(id,funcao)
            {
              var page = "config/aluno.php";
              $.ajax
              ({
                type: 'POST',
                dataType: 'html',
                url: page,
                data: {id: id,
                  funcao : funcao
                },
                success: function (msg)
                {
                  //////////////
                  if(funcao=="Ativar")
                  {
               //Chama o método ajax
               alert("Ativado com sucesso!");
             }

             else if(funcao=="Desativar")
             {

              alert("Desativado com sucesso!"); 
            }

            else if(funcao=="Excluir")
            {
             alert("Excluido com sucesso!");  
           }

           buscar(0,0,0);
           //////////////
         }
       });
            }
      
      </script>

      <?php 
} //fecha IF da validação de Administrador

else
{
   echo "<script>window.location = 'index.php'</script>";
  echo "<a href='index.php'>Página Inicial</a>";
}







