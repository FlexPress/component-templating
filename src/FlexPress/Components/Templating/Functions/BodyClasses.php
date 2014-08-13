<?php

namespace FlexPress\Components\Templating\Functions;

use FlexPress\Components\Templating\FunctionInterface;

class BodyClasses implements FunctionInterface
{

    /**
     * WordPress wp query object
     * @var \WP_Query
     */
    protected $query;

    public function __construct(\WP_Query $query)
    {
        $this->query = $query;
    }

    /**
     * Return the name of the twig function
     *
     * @return mixed
     * @author Tim Perry
     */
    public function getFunctionName()
    {
        return "BodyClasses";
    }

    /**
     * The function that is executed when called in a template
     *
     * @return mixed
     * @author Tim Perry
     */
    public function getFunctionBody()
    {
        $post = $this->query->get_queried_object();
        return 'class="' . implode(" ", $this->getBodyClasses($post)) . '"';
    }

    /**
     *
     * Returns the list of classes
     *
     * @param $post
     * @return array
     * @author Tim Perry
     */
    protected function getBodyClasses($post)
    {
        $classes = array();

        if (is_single()) {
            $classes[] = "single";
        } else {
            $classes[] = "page";
        }

        if (is_404()) {
            $classes[] = 'page--404';
        } elseif (is_front_page()) {
            $classes[] = 'page--front';
        } elseif (is_home()) {
            $classes[] = 'page--news';
        } elseif (is_search()) {
            $classes[] = 'page--search';
        } elseif (is_single()
            && $postType = strtolower(str_replace("_", "-", $post->post_type))
        ) {
            $classes[] = "single--" . $postType;
        }

        if (is_user_logged_in()) {
            $classes[] = 'has-admin-bar';
        }

        return $classes;
    }
}
