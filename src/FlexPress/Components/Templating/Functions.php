<?php

namespace FlexPress\Components\Templating;

class Functions
{

    /**
     * @var \SplObjectStorage
     */
    protected $functions;

    /**
     * @param \SplObjectStorage $functions
     * @param array $functionsArray
     * @throws \RuntimeException
     * @author Tim Perry
     */
    public function __construct(\SplObjectStorage $functions, array $functionsArray)
    {
        $this->functions = $functions;

        if (!empty($functionsArray)) {

            foreach ($functionsArray as $function) {

                if (!$function instanceof FunctionInterface) {

                    $message = "One or more of the functions you have passed to ";
                    $message .= get_class($this);
                    $message .= " does not extend the Function interface.";

                    throw new \RuntimeException($message);

                }

                $this->functions->attach($function);

            }

        }

        add_action('get_twig', array($this, 'getTwig'));
    }

    /**
     * Adds all the functions into the twig environment
     *
     * @param \Twig_Environment $twig
     * @return \Twig_Environment
     * @author Tim Perry
     */
    public function getTwig(\Twig_Environment $twig)
    {

        $this->functions->rewind();
        while ($this->functions->valid()) {

            $function = $this->functions->current();
            $twig->addFunction(new \Twig_SimpleFunction($function->getFunctionName(), array($function, 'getFunctionBody')));
            $this->functions->next();

        }

        return $twig;

    }
}
