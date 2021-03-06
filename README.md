# Graphic Editor
[![Build Status](https://travis-ci.org/IVIR3zaM/GraphicEditor.svg?branch=master)](https://travis-ci.org/IVIR3zaM/GraphicEditor) [![Maintainability](https://api.codeclimate.com/v1/badges/2790fdb852cad7e36ecc/maintainability)](https://codeclimate.com/github/IVIR3zaM/GraphicEditor/maintainability) [![Issue Count](https://codeclimate.com/github/IVIR3zaM/GraphicEditor/badges/issue_count.svg)](https://codeclimate.com/github/IVIR3zaM/GraphicEditor) [![Test Coverage](https://codeclimate.com/github/IVIR3zaM/GraphicEditor/badges/coverage.svg)](https://codeclimate.com/github/IVIR3zaM/GraphicEditor/coverage)

This is a test project for a company. It's not a production level library


## Project Description

This is a controller-cli application that can get an array of geometric shapes and draw result in any format. for start it should have implementation of Circle and Square for shapes and Array Points and Binary Images as output handlers (I call them Drivers).

**NOTE:** It should be an easy way to add a new Shape or Driver with minimum changes and coding.


### Some Discussions About Possible Solutions

**Solution 1:** The simplest way is to use an Abstract Factory for creating shapes with any types of Drivers. but there are massive actions for adding a new Shape or a new Driver. so let left it behind.

**Solution 2:** The other way is to use Builder Pattern for Drivers and implement a make function for each Shape inside each Driver. it's more reliable but the main problem still exists. we can't add any shape without modifying our Drivers. so it's not a best practice.

**Final Solution:** So lets think about what is a share point in all shapes in the world? with an answer to this question, we can provide a method for each Shape to convert the Shape to that form, then our Drivers have to only implement drawing that form. brilliant?! hah?!
 
After some thinking and researching, I've found two global forms of Shapes. Pixel Form and Vector Form.

The first is used in Photoshop, Paint and many softwares. Pixels are the purest form of any Shape in Digital world. Actually any Vectors at the final step changes to Pixels for showing on a monitor or printing on a paper.
 
The second is used in Illustrator, Corel Draw and the others. Vector is actually the formula to recreate a Shape base on 4 main types of Lines. 1- Strait Line, 2- Arc Line, 3- Quadratic Bézier Curve, 4- Cubic Bézier Curve. 

Implementing Vectors in many Drivers is a challenging task and using them is an excessive obsession behavior here. And really we don't need them right now, so I decide to use Pixels form for Shapes. Now implementing any Shape is easy. I should abstract Shapes with an Abstract method for getting a list of their Pixels. It's all, lets start codding!

## How to use
This project powered by FlyWeight, Facade, Factory and Iterator Design Patterns. For a quick start you can use EditorFacade class. By watching it's test you can find how it's working. But for a reliable approach you can use the simple command line tool (cli.php). here is an example:

```
php cli.php Editor:Json '{"circle":{"cx":300,"cy":300,"radius":300,"color":"#ff0000"}}'
```

The first parameter is [task name]:[action name]. And the second parameter is json encoded list of shapes. This command simply print points as a json string. Now see this example:

```
php cli.php Editor:Image '{"circle":{"cx":300,"cy":300,"radius":300,"color":"#ff0000"}}' png 0
```

This command use BinaryImage Driver for it's output and show you binary data for a png image (third parameter) with no padding (forth parameter).

It's simple!

## How to add new Shape or new Driver
For adding new Shape only add new class in namespace IVIR3aM\GraphicEditor\Shapes and extends ShapeAbstract. Then you can add getter-setters for it's parameters and also implement getPixels() method to calculate the shape's pixels to show.

For adding new Driver only add new class in namespace IVIR3aM\GraphicEditor\Drivers and implements DriverInterface. Then the only method that you have to implement is draw() method that get PixelList and return a Response.
