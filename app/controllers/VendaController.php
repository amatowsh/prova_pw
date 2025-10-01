<?php

class VendaController
{
    public function registrar()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_produto = $_POST['id_produto'];
            $quantidade = (int)$_POST['quantidade'];

            $produtoModel = new Produto();
            $produto = $produtoModel->findById($id_produto);

            if ($produto && $quantidade > 0 && $quantidade <= $produto['estoque']) {
                $valor_total = $produtoModel->calcularValorTotal($quantidade, $produto['valor']);

                $pdo = Database::getConnection();
                $pdo->beginTransaction();

                try {
                    Venda::registrar($id_produto, $quantidade, $valor_total);

                    Produto::atualizarEstoque($id_produto, $quantidade);

                    $pdo->commit();

                    $_SESSION['mensagem'] = "Venda registrada com sucesso!";
                    $_SESSION['tipo_mensagem'] = "success";
                } catch (Exception $e) {
                    $pdo->rollBack();
                    $_SESSION['mensagem'] = "Erro ao registrar a venda: " . $e->getMessage();
                    $_SESSION['tipo_mensagem'] = "danger";
                }
            } else {
                $_SESSION['mensagem'] = "Quantidade inválida ou estoque insuficiente.";
                $_SESSION['tipo_mensagem'] = "warning";
            }
        }
        header('Location: index.php?controller=produto&action=listar');
        exit();
    }

    public function historico()
    {
        $vendas = Venda::getHistorico();
        $this->view('vendas/historico', ['vendas' => $vendas]);
    }

    protected function view(string $view, array $data = []): void
    {
        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        if (!file_exists($viewFile)) {
            http_response_code(500);
            echo "<h1>Erro</h1><p>View '$view' não encontrada.</p>";
            return;
        }
        extract($data);
        require $viewFile;
    }
}
