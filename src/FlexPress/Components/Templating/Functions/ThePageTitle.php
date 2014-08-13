<?php

namespace FlexPress\Components\Templating\Functions;

use FlexPress\Components\Templating\FunctionInterface;

class ThePageTitle implements FunctionInterface
{

    /**
     * Return the name of the twig function
     *
     * @return mixed
     * @author Tim Perry
     */
    public function getFunctionName()
    {
        return "thePageTitle";
    }

    /**
     * The function that is executed when called in a template
     *
     * @return mixed
     * @author Tim Perry
     */
    public function getFunctionBody()
    {

        global $page, $paged;

        wp_title('|', true, 'right');

        // Add the blog name.
        bloginfo('name');

        // Add the blog description for the home/front page.
        $site_description = get_bloginfo('description', 'display');

        if ($site_description && (is_home() || is_front_page())) {
            echo " | ", $site_description;
        }

        // Add a page number if necessary:
        if ($paged >= 2 || $page >= 2) {
            echo ' | ', sprintf(__('Page %s', 'twentyeleven'), max($paged, $page));
        }

    }
}
