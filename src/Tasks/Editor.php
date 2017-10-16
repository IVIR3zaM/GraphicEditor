<?php
namespace IVIR3aM\GraphicEditor\Tasks;

use IVIR3aM\GraphicEditor\Drivers\BinaryImage;
use IVIR3aM\GraphicEditor\Drivers\JsonArrayPoints;
use IVIR3aM\GraphicEditor\EditorFacade;

class Editor
{
    protected function getShapesFromParams($params)
    {
        if (isset($params[0])) {
            $shapes = @json_decode($params[0], true);
            if (is_array($shapes)) {
                return $shapes;
            }
        }
        return [];
    }

    public function ImageAction($params = [])
    {
        $editor = new EditorFacade($this->getShapesFromParams($params), [
            'Driver' => BinaryImage::class,
        ]);
        if (isset($params[1])) {
            $editor->getEditor()->getDriver()->setType($params[1]);
        }
        if (isset($params[2])) {
            $editor->getEditor()->getDriver()->setPadding($params[2]);
        }
        return $editor->getResponse();
    }

    public function JsonAction($params = [])
    {
        $editor = new EditorFacade($this->getShapesFromParams($params), [
            'Driver' => JsonArrayPoints::class,
        ]);
        return $editor->getResponse();
    }
}