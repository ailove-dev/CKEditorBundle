<?php

namespace Ailove\CKEditorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function uploadAction(Request $request)
    {


        $extArr = array('jpg', 'jpeg', 'png', 'gif');

        $CKEditorFuncNum = $request->query->get('CKEditorFuncNum');

        /**
         * @var \Symfony\Component\HttpFoundation\File\UploadedFile $formParam
         */
        $formParam = $request->files->get('upload');
        if (!is_null($formParam)) {

            $media = new \Application\Sonata\MediaBundle\Entity\Media();

            $media->setBinaryContent($formParam->getFileInfo()->getRealPath());

            /**
             * @var \Sonata\MediaBundle\Model\MediaManagerInterface $mediaManager
             */
            $mediaManager = $this->get('sonata.media.manager.media');


            try {

                $context = $this->container->getParameter('ailove_ckeditor.media.context');

                $mediaManager->save($media, $context, 'sonata.media.provider.image');
                /**
                 * @var \Sonata\MediaBundle\Provider\ImageProvider $imageProvider
                 */
                $imageProvider = $this->get('sonata.media.provider.image');

                $content = '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction(' . $CKEditorFuncNum . ', "' . $imageProvider->generatePublicUrl($media, 'reference') . '", "");</script>';

            } catch (\Exception $e) {
                $content = '<script type="text/javascript">alert( "Произошла ошибка на сервере ' . $e->getMessage() . '" ); window.parent.CKEDITOR.tools.callFunction(' . $CKEditorFuncNum . ', "", "");</script>';

            }

        } else {
            $content = '<script type="text/javascript">alert( "Ошибка! Отсутствует файл для закачки." ); window.parent.CKEDITOR.tools.callFunction(' . $CKEditorFuncNum . ', "", "");</script>';
        }
        return new \Symfony\Component\HttpFoundation\Response($content);
    }
}
