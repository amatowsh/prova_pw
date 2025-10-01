<?php

class ProdutoController
{
    public function listar()
    {
        $produtos = Produto::getAll();
        $this->view('produtos/listar', ['produtos' => $produtos]);
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
