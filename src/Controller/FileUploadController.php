<?php
declare(strict_types=1);

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class FileUploadController extends AbstractController
{
    private $projectDir;

    public function __construct($projectDir)
    {
        $this->projectDir = $projectDir;
    }

    /**
     * @param Request $request
     *
     * @Method("POST")
     *
     * @Route("/file/upload", name="file_upload")
     *
     * @return Response
     *
     * @throws AccessDeniedException
     * @throws FileException
     */
    public function upload(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'unable to upload the file');

        $fileName = null;

        /** @var UploadedFile $file **/
        foreach ($request->files as $file) {
            $fileName = $file->getClientOriginalName().'.'.$file->guessClientExtension();
            $file->move($this->projectDir.'/public/img/uploads/blog', $fileName);
        }

        //must return json and have { "uploaded":"true" } in the response to make ckeditor5 work (without showing pop up).
        return new JsonResponse(
            [
                'uploaded' => 'true',
                'url' => '/img/uploads/blog/'.$fileName
            ]
        );
    }
}