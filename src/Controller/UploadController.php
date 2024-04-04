<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class UploadController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/upload', name: 'app_upload')]
    public function uploadPage(): Response
    {
        return $this->render('pages/accueil/upload.html.twig');
    }
    

    #[Route('/upload_file', name: 'app_upload_file')]
    public function upload(Request $request)
    {
        try {
            $file = $request->files->get('fichier');
        }
        catch (FileException $e) {
            return $this->render('pages/accueil/uploadResult.html.twig',[
                'error' => 'Format invalide ou fichier manquant',
            ]);
        }
        
        try{
            $pseudo = $request->getSession()->get('pseudo');
        }
        catch (FileException $e) {
            return $this->render('pages/accueil/uploadResult.html.twig',[
                'error' => 'Vous n\'êtes pas connecté',
            ]);
        }

        try{
            if ($file) {
                $tempPath = $file->getRealPath();
                $uploadDirectory = $this->getParameter('upload_directory').'/'.$pseudo;
                try{
                    if (!file_exists($uploadDirectory)) {
                        mkdir($uploadDirectory, 0777, true);
                    }
                }
                catch (FileException $e) {
                    return $this->render('pages/accueil/uploadResult.html.twig',[
                        'error' => 'Une erreur est survenue lors de la création du dossier',
                    ]);
                }
                try {
                    $destinationPath = $uploadDirectory . '/' . $file->getClientOriginalName();
                    move_uploaded_file($tempPath, $destinationPath);
                    return $this->render('pages/accueil/uploadResult.html.twig',[
                        'error' => 'Upload du fichier réussit, il se trouvera dans le dossier public/uploads/'.$pseudo.'/',
                    ]);
                }
                catch (FileException $e) {
                    return $this->render('pages/accueil/uploadResult.html.twig',[
                        'error' => 'Une erreur est survenue lors de la sauvegarde du dossier',
                    ]);
                }
            }
        }
        catch (FileException $e) {
            return $this->render('pages/accueil/uploadResult.html.twig',[
                'error' => 'Erreur avec le fichier',
            ]);
        }
    }
}
