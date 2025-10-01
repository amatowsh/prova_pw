<?php

class HomeController
{
    public function index(): void
    {
        $produto = new Produto();
        $produtos = $produto->listar();

        $this->view('home/index', [
            'titulo' => 'Projeto Vendas - Home',
            'produtos' => $produtos,
        ]);
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
