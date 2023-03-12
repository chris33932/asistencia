<?php

namespace App\Controller;

use App\Entity\Asistencia;
use App\Entity\User;
use App\Form\AsistenciaType;
use App\Repository\AsistenciaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Time;


#[Route('/asistencia/admin')]
class AsistenciaAdminController extends AbstractController
{
    #[Route('/', name: 'app_asistencia_admin_index', methods: ['GET'])]
   
   
   
    public function index(AsistenciaRepository $asistenciaRepository): Response
    {   
       
        return $this->render('asistencia/indexAdmin.html.twig', [
            'asistencias' => $asistenciaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_asistencia_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AsistenciaRepository $asistenciaRepository): Response
    {
        $asistencium = new Asistencia();
        $user = $this->getUser();
        //var_dump($userid);
        //$username=serialize($userid);
        //var_dump($username);die;
        $asistencium-> setUser($user);
        $asistencium->setFecha(new \DateTime(('now')));
        $asistencium->setTime(new \DateTime(('now')));
        $form = $this->createForm(AsistenciaType::class, $asistencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $asistenciaRepository->save($asistencium, true);

            return $this->redirectToRoute('app_asistencia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('asistencia/new.html.twig', [
            'asistencium' => $asistencium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_asistencia_show', methods: ['GET'])]
    public function show(Asistencia $asistencium): Response
    {
        return $this->render('asistencia/show.html.twig', [
            'asistencium' => $asistencium,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_asistencia_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Asistencia $asistencium, AsistenciaRepository $asistenciaRepository): Response
    {
        $form = $this->createForm(AsistenciaType::class, $asistencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $asistenciaRepository->save($asistencium, true);

            return $this->redirectToRoute('app_asistencia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('asistencia/edit.html.twig', [
            'asistencium' => $asistencium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_asistencia_delete', methods: ['POST'])]
    public function delete(Request $request, Asistencia $asistencium, AsistenciaRepository $asistenciaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$asistencium->getId(), $request->request->get('_token'))) {
            $asistenciaRepository->remove($asistencium, true);
        }

        return $this->redirectToRoute('app_asistencia_index', [], Response::HTTP_SEE_OTHER);
    }
}
