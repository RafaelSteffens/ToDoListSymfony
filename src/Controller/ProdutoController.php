<?php 

namespace App\Controller;

use App\Entity\Produto;
use App\form\ProdutoType;

use App\Repository\ProdutoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProdutoController extends AbstractController
{
    #[Route("/produto" , name:"produto_index")]
    #[IsGranted('ROLE_USER')]
    public function index (ProdutoRepository $produtoRepository)
    {
        //busca produtos cadatsrados
        $data['produtos'] = $produtoRepository->findAll();
        $data['titulo'] = "Gerencias produtos";

        return $this->render("produto/index.html.twig", $data);


    }
    #[Route("/produto/adicionar", name:"produto_adicionar")]
    #[IsGranted('ROLE_USER')]
    public function adicionar(Request $request, EntityManagerInterface $em) : Response
    {
        $msg='';
        $produto = new Produto();
        $form = $this->createForm(ProdutoType::class, $produto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($produto);
            $em->flush();
            $msg='Produto adicionado com sucesso';

        }

        $data['titulo']="Adicionar novo produto";
        $data['form']=$form;
        $data['msg']=$msg;

        return $this->render('produto/form.html.twig', $data);
    }
    #[Route('produto/editar/{id}', name:'produto_editar')]
    #[IsGranted('ROLE_USER')]
    public function editar($id, Request $request, EntityManagerInterface $em, ProdutoRepository $produtoRepository) : Response
    {
        $msg='';
        $produto = $produtoRepository->find($id);
        $form = $this->createForm(ProdutoType::class, $produto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->flush(); //Faz o upotade no banco de dados
            $msg='Produto atualizado com sucesso';
        }
        $data['titulo']= 'Editar produto';
        $data['form'] = $form;
        $data['msg'] = $msg;

        return $this->render('produto/form.html.twig', $data);
    }
    #[Route('/produto/excluir/{id}', name:'produto_excluir')]
    #[IsGranted('ROLE_USER')]
    public function excluir($id, EntityManagerInterface $em, ProdutoRepository $produtoRepository) : Response
    {
        $produto = $produtoRepository->find($id);

        $em->remove($produto);
        $em->flush();

        return $this->redirectToRoute('produto_index');


    }
}