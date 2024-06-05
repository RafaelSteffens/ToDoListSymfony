<?php
namespace App\Services;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

use App\Repository\ProdutoRepository;

class ProdutoService
{
    public $produtoRepository;
    public function __construct(ProdutoRepository $produtoRepository) {
        $this->produtoRepository = $produtoRepository;
    }

    


    public function contaProdutosPorCategoria($categorias)
    {
        $produtos = $this->produtoRepository->findAll();

        $contaProduto = [];

        foreach( $categorias as $categoria ) {
            $contador = 0;

            foreach($produtos as $produto)
            {
                if($produto->getCategoria() == $categoria){
                    $contador++;
                }
            }
            $contaProduto[$categoria->getId()] = $contador;
            
        }
        return $produtos;
    }
}