<?php
namespace App\Services;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use App\Entity\Categoria;
use App\Form\CategoriaType;

use App\Repository\CategoriaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class CategoriaService extends AbstractController
{
    public $categoriaRepository;
    public $em;
    public function __construct(CategoriaRepository $categoriaRepository, EntityManagerInterface $em) {
        $this->categoriaRepository = $categoriaRepository;
        $this->em = $em;
    }


    #[IsGranted('ROLE_USER')]
    public function listarCategorias()
    {
        return $this->categoriaRepository->findAll();
    }


    public function salvar($form, $categoria) 
    {
        if ($form->isSubmitted() && $form->isValid()){    
            try{       
                    $this->em->persist($categoria);
                    $this->em->flush();

            } catch(Exception $e) {
                return $e->getMessage();
                }

        }
    }
    
    public function editar($id)
    {
        $categoriax = $this->categoriaRepository->find($id);
        return $categoriax;

    }
    

    }

    



