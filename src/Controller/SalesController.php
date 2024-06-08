<?php

namespace App\Controller;

use App\Entity\Sales;
use App\Form\SalesType;
use App\Repository\ProdutoRepository;
use App\Repository\SalesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class SalesController extends AbstractController
{
    #[Route('/sales', name: 'app_sales')]
    public function index(ProdutoRepository $produtoRepository): Response
    {
        $data['produtos'] = $produtoRepository->findAll();
        $data['titulo'] = "Página de vendas";

        return $this->render('sales/index.html.twig', $data);
    }

    #[Route('/comprar/{id}', name:'app_comprar')]
    public function comprar($id, Request $request, EntityManagerInterface $em, ProdutoRepository $produtoRepository) : Response
    {
        $msg="";
        $sales = new Sales();
        
        $form = $this->createForm(SalesType::class, $sales);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $sales->setProdutosId($id);
            $em->persist($sales);
            $em->flush();
            $msg= "Compra concluida, você receberá um email com mais informações";
        }

        $data['titulo']="Nova compra: ";
        $data['form'] = $form;
        $data['msg'] = $msg;

        return $this->render('sales/form.html.twig', $data);

    }
    #[Route('/pedidos', name: 'app_pedidos')]
    #[IsGranted('ROLE_USER')]
    public function pedidos (SalesRepository $salesRepository) : Response
    {
        $data['vendas'] = $salesRepository->findAll();
        $data['titulo'] = "Página de pedidos";

        return $this->render('sales/pedidos.html.twig', $data);
    }

}
