<?php
    class ClientView{
        public function __construct($params){
            $env = parse_ini_file('env.ini')['HOST'];
?>
            <!DOCTYPE html>
            <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="/public/css/client.css">
                <title>Clientes</title>
                <script>
                    const host =  '<?php echo $env; ?>';
                </script>
            </head>

            <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
            <script src="https://unpkg.com/feather-icons"></script>

            <body>
            <?php include "components/Sidebar.php" ?>
            <main class="wide">
            <header>
                <i class="menu-toggle" data-feather="menu"></i>
                <div class="header-conteudo">
                    <h1>CLIENTES</h1>
                    <div class="botoesDireito">
                        <a href="/add/client" class="btnAdd">Adicionar cliente<i data-feather="plus"></i></a>
                        <div class="pesquisar">
                            <input type="text" id="input" name="pesquisar" placeholder="Pesquisar na tabela" onkeyup="filtrarCliente()">
                            <i data-feather="search" class="iconePesquisa"></i>
                        </div>
                    </div>
                </div>
            </header>
            <div class="content">
                <table class="tabela-consulta">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nome</td>
                            <td>Telefone</td>
                            <td>CPF</td>
                            <td>Ação</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($params['clients'] as $client){ ?>
                            <tr>
                                <td><?php echo $client['id']; ?></td>
                                <td><?php echo $client['nome']; ?></td>
                                <td><?php echo $client['telefone']; ?></td>
                                <td><?php echo $client['cpf']; ?></td>
                                <td><button type="button" class="abrir-modal" onclick="consultarCliente(<?php echo $client['id']; ?>)">
                                    <i data-feather="search"></i></button>
                                </td>
                            </tr>
                            <div class="modal disabled">
                                <div class="cliente">
                                    <button type="button" class="fechar-modal">
                                        <i data-feather="x"></i>
                                    </button>
                                    <div class="conteudoCliente"></div>
                                    <div class="botoesModal">
                                        <a href="/edit/client&id=<?php echo $client['id']; ?>" class="btnEditar">Editar<i data-feather="edit"></i></a>
                                        <a href="/delete/client&id=<?php echo $client['id']; ?>" class="btnDeletar">Deletar <i data-feather="trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </tbody>
                </table>
                <h1>
                    <?php
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    ?>
                </h1>
            </div>
            </main>

            <script src="/public/js/ClientFunctions.js"></script>
            <script src="/public/js/global.js"></script>

            </body>
            </html>
        <?php }
    }

?>