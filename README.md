# FlexPress templating component

## Install via Pimple
The templating components a class and a interface:
- Functions, which hooks into the Twig environment and adds the functions you add to it.
- FunctionInterface, an interface that you must adheer to.

Lets create the pimple config for the functions and a Hello World function class that we will create later:

```
$pimple['helloWorldFunction'] = function() {
  return new HelloWorld();
};

$pimple['templatingFunctions'] = function ($c) {
    return new TemplatingFunctions($c['objectStorage'], array(
      $c['helloWorldFunction']
    ));
};
```

Note the objectStorage is the SPLObjectStorage class.

## Creating a concreate class that implments the interface

You need to implement the FunctionsInterface and create a class that can be added to the Functions service, so lets create a simple hello world one now:
```
class HelloWorld implements FunctionInterface {
  
  public function getFunctionName() {
    return "helloWorld";
  }

  public function getFunctionBody() {
    echo "Hello world";
  }

}
```

As you can see the getFunctionName() gets the name of the function and the getFunctionBody() is what is outputted when you call the function.

Before we use this in the a twig view we need to get the templatingFunctions service to register the functions, simply create an instance of it and it will setup the hooks, so just call the pimple config:

```
$pimple['templatingFunctions'];
```

Finally you would use this in a view like this

```
{{ helloWorld() }}
```

## Public methods - Functions
- getTwig() - Used by a hook to add in all the functions

## Public methods - FunctionInterface
- getFunctionName() - Returns the name of the function.
- getFunctionBody() - This method is called when you use the function in a view, can do anything you want.

## Builtin functions

As well as creating your own functions there are a few built in functions:

- BodyClasses - Used to output the classes for the <body> tag.
- ThePageTitle - Used to output the page title inside the <title> tags.
