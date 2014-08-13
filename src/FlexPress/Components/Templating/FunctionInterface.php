<?php

namespace FlexPress\Components\Templating;

interface FunctionInterface
{
    /**
     * Return the name of the twig function
     *
     * @return mixed
     * @author Tim Perry
     */
    public function getFunctionName();

    /**
     * The function that is executed when called in a template
     *
     * @return mixed
     * @author Tim Perry
     */
    public function getFunctionBody();
}