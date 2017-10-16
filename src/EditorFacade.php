<?php
namespace IVIR3aM\GraphicEditor;

use IVIR3aM\GraphicEditor\Colors\FlyweightFactory;
use IVIR3aM\GraphicEditor\Colors\FlyweightFactoryInterface as ColorFactoryInterface;
use Exception;
use ReflectionClass;
use IVIR3aM\GraphicEditor\Drivers\BinaryImage;
use IVIR3aM\GraphicEditor\Pixels\Factory as PixelFactory;
use IVIR3aM\GraphicEditor\Responses\Factory as ResponseFactory;
use IVIR3aM\GraphicEditor\Pixels\ListFacade as PixelListFacade;
use IVIR3aM\GraphicEditor\Pixels\PixelList;
use IVIR3aM\GraphicEditor\Shapes\ShapeList;

class EditorFacade implements EditorFacadeInterface
{
    protected $editor;
    protected $colorFactory;
    protected $isSetup = false;
    protected $defaultSettings = [
        'ColorFactory' => FlyweightFactory::class,
        'PixelList' => PixelList::class,
        'PixelFactory' => PixelFactory::class,
        'PixelListFacade' => PixelListFacade::class,
        'ResponseFactory' => ResponseFactory::class,
        'ShapeList' => ShapeList::class,
        'Driver' => BinaryImage::class,
        'Editor' => Editor::class,
    ];
    protected $settings = [];

    public function __construct($settings = [])
    {
        $this->setSettings($settings);
    }

    protected function getNewObject($name)
    {
        if (!isset($this->settings[$name])) {
            throw new Exception("Undefined class name '{$name}'");
        }
        $arguments = func_get_args();
        unset($arguments[0]);

        $class = $this->settings[$name];
        if (empty($arguments)) {
            return new $class();
        }
        $arguments = array_values($arguments);
        return (new ReflectionClass($class))->newInstanceArgs($arguments);
    }

    protected function setSettings($settings = [])
    {
        $this->settings = $this->defaultSettings;
        foreach ($settings as $name => $class) {
            if (!isset($this->settings[$name]) || !class_exists($class)) {
                continue;
            }
            $this->settings[$name] = $class;
        }
    }

    public function setUp($settings = [])
    {
        $this->setSettings($settings);
        $this->setColorFactory($this->getNewObject('ColorFactory'));
        $editor = $this->getNewObject('Editor');

        $pixelList = $this->getNewObject('PixelList');
        $pixelFactory = $this->getNewObject('PixelFactory');
        $pixelListFacade = $this->getNewObject('PixelListFacade', $pixelList, $pixelFactory);

        $editor->setPixelListFacade($pixelListFacade);
        $editor->setResponseFactory($this->getNewObject('ResponseFactory'));
        $editor->setShapeList($this->getNewObject('ShapeList'));
        $editor->setDriver($this->getNewObject('Driver'));
        $this->setEditor($editor);
        $this->isSetup = true;
    }

    protected function checkSetup()
    {
        if (!$this->isSetup) {
            $this->setUp();
        }
    }

    /**
     * @param int $red
     * @param int $green
     * @param int $blue
     * @return ColorInterface
     */
    public function getColor($red = 0, $green = 0, $blue = 0)
    {
        $this->checkSetup();
        return $this->getColorFactory()->getColor($red, $green, $blue);
    }

    public function addShape(ShapeAbstract $shape)
    {
        $this->checkSetup();
        $this->getEditor()->getShapeList()->addShape($shape);
        return $this;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        $this->checkSetup();
        return $this->getEditor()->getResponse();
    }

    public function setColorFactory(ColorFactoryInterface $factory)
    {
        $this->colorFactory = $factory;
        return $this;
    }

    public function getColorFactory()
    {
        return $this->colorFactory;
    }

    public function setEditor(EditorInterface $editor)
    {
        $this->editor = $editor;
        return $this;
    }

    public function getEditor()
    {
        return $this->editor;
    }
}