<?php 

namespace App\Controller;

use App\Entity\Categoria;
use App\Entity\Produto;
use App\Services\CategoriaService;
use App\Services\ProdutoService;
use App\Form\CategoriaType;
use App\Repository\CategoriaRepository;
use App\Repository\ProdutoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


class CategoriaController extends AbstractController
{
   
    #[Route('/categoria', name:'categoria')]
    #[IsGranted('ROLE_USER')]
    public function index (CategoriaService $categoriaService, Request $request) : Response
    {
   

        $msg="";
        
        $categorias = $categoriaService->listarCategorias();

        
        $categoria = new Categoria();
        $form = $this->createForm(CategoriaType::class, $categoria);
        $form->handleRequest($request);
        
        $adicionar = $categoriaService->salvar($form, $categoria);



        $data['form'] = $form;
        $data['salvar'] = $adicionar;
        $data['categorias'] = $categorias;
        $data['titulo']='Gerenciar categorias';
        $data['msg'] = $msg;

        return $this->render('categoria/index.html.twig', $data);

    }



     #[Route('/categoria/{id}', name:'categoria_editar')]
    // #[IsGranted('ROLE_USER')]
     public function editar($id, Request $request, CategoriaService $categoriaService) : Response
    // {
        $categoria_id = $categoriaService->editar(1);  
        $form_editar = $this->createForm(CategoriaType::class, $categoria_id);
        $form_editar->handleRequest($request) ; 
        $editarx = $categoriaService->salvar($form_editar, $categoria_id);
            
        $data['form_editar'] = $form_editar;
        $data['editar'] = $editarx;
             return $this->render('categoria/form.html.twig', $data);
    //     }

    //     #[Route('/categoria/excluir/{id}', name:'categoria_excluir')]
    //     #[IsGranted('ROLE_USER')]
    //     public function excluir ($id, EntityManagerInterface $em, CategoriaRepository $categoriaRepository, ProdutoRepository $produtoRepository) : Response
    //     {
    //         $msg="";
    //         $categoria = $categoriaRepository->find($id);

    //         $produtos  = $produtoRepository->findAll();
    //         $podeExcluir = True;

    //         foreach ($produtos as $produto){
    //             if ($produto->getCategoria() === $categoria)
    //             {
    //                 $podeExcluir=False;
    //                 $msg="Categoria não pode ser excluida com  produtos cadastatados!";
    //                 break;
    //             } 
    //         }
                
    //         if ($podeExcluir == True){
    //             $msg="Categoria Excluida com sucesso!";
    //             $em->remove($categoria); // exlcui a categoria a nivel de memoria
    //             $em->flush(); //vai efetivamente exluir no bd
                
    //             }
                            
    //         $data["msg"] = $msg;
    //         //redirecionar a aplicação para o categoria index
    //         return $this->redirectToRoute('categoria', $data);
    //     }
}