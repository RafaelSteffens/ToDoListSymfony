<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TesteController extends AbstractController
{
    #[Route('/teste', name: 'testequalquer')]
    public function index(): Response
    {
        $data['titulo'] = 'Página de rafael';
        $data['mensagem'] = 'Aprendendo templatyes no sinfony';
        $data['frutas'] = ['banana', 'laranja', 'abacaxi'];
        $data['entregas'] =[ 
        [
            'nome'=> 'loggi',
            'valor'=> '7,77',
        ],
        [
            'nome'=> 'kangu',
            'valor'=> '7,77',
        ]
        ];
        return $this->render('teste/index.html.twig', $data);
    }
    #[Route('/teste/detalhes/{id}', name:'detalhes')]
    public function detalhes($id) : Response
    {
        $data['id'] = $id;
        $data['titulo'] = 'Pagina de detalhes';
        return $this->render('teste/detalhes.html.twig', $data);
    }
}