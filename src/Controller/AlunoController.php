<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Aluno;

class AlunoController extends AbstractController
{
    /**
     * @Route("/aluno/criar_automaticamente", name="criar_automaticamente")
     */
    public function criarAutomaticamente(): Response
    {
        $alunos = array(
            "Heládio" => "Doce de Leite",
            "Amanda" => "John People",
            "Nadjane" => "Avonlea",
            "Izaquiel" => "Flowers",
            "Flavio" => "Gramado pernambucana",
            "Isaias" => "Terra do pequi",
            "Jameson" => "do mundo"
        );

        foreach ($alunos as $nome => $localidade) {

            $aluno = new Aluno();
            $aluno->setNome($nome);
            $aluno->setCidade($localidade);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($aluno);
            $entityManager->flush();
        }
        return new Response('Os alunos foram adicionados!');
    }

    /**
     * @Route("/aluno/delete/{id}")
     */
    public function delete(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $aluno = $entityManager->getRepository(Aluno::class)->find($id);
        $entityManager->remove($aluno);
        $entityManager->flush();
        return new Response('O aluno da cidade <b>'.$aluno->getCidade().'</b> foi removido');
    }


}
