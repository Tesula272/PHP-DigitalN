<form class="d-flex" id="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>>">
    <input type="text" class="form-control me-2" name="s" placeholder="Search" value="<?php echo get_search_query(); ?>">
    <button type="submit" class="btn btn-primary">Search</button>
</form>





<?php

function get_search_form( $args = array() ) {
    /**
     * Fires before the search form is retrieved, at the start of get_search_form().
     *
     * @since 2.7.0 as 'get_search_form' action.
     * @since 3.6.0
     * @since 5.5.0 The `$args` parameter was added.
     *
     * @link https://core.trac.wordpress.org/ticket/19321
     *
     * @param array $args The array of arguments for building the search form.
     *                    See get_search_form() for information on accepted arguments.
     */
    do_action( 'pre_get_search_form', $args );
 
    $echo = true;
 
    if ( ! is_array( $args ) ) {
        /*
         * Back compat: to ensure previous uses of get_search_form() continue to
         * function as expected, we handle a value for the boolean $echo param removed
         * in 5.2.0. Then we deal with the $args array and cast its defaults.
         */
        $echo = (bool) $args;
 
        // Set an empty array and allow default arguments to take over.
        $args = array();
    }
 
    // Defaults are to echo and to output no custom label on the form.
    $defaults = array(
        'echo'       => $echo,
        'aria_label' => '',
    );
 
    $args = wp_parse_args( $args, $defaults );
 
    /**
     * Filters the array of arguments used when generating the search form.
     *
     * @since 5.2.0
     *
     * @param array $args The array of arguments for building the search form.
     *                    See get_search_form() for information on accepted arguments.
     */
    $args = apply_filters( 'search_form_args', $args );
 
    // Ensure that the filtered arguments contain all required default values.
    $args = array_merge( $defaults, $args );
 
    $format = current_theme_supports( 'html5', 'search-form' ) ? 'html5' : 'xhtml';
 
    /**
     * Filters the HTML format of the search form.
     *
     * @since 3.6.0
     * @since 5.5.0 The `$args` parameter was added.
     *
     * @param string $format The type of markup to use in the search form.
     *                       Accepts 'html5', 'xhtml'.
     * @param array  $args   The array of arguments for building the search form.
     *                       See get_search_form() for information on accepted arguments.
     */
    $format = apply_filters( 'search_form_format', $format, $args );
 
    $search_form_template = locate_template( 'searchform.php' );
 
    if ( '' !== $search_form_template ) {
        ob_start();
        require $search_form_template;
        $form = ob_get_clean();
    } else {
        // Build a string containing an aria-label to use for the search form.
        if ( $args['aria_label'] ) {
            $aria_label = 'aria-label="' . esc_attr( $args['aria_label'] ) . '" ';
        } else {
            /*
             * If there's no custom aria-label, we can set a default here. At the
             * moment it's empty as there's uncertainty about what the default should be.
             */
            $aria_label = '';
        }
 
        if ( 'html5' === $format ) {
            $form = '<form role="search" ' . $aria_label . 'method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
                <label>
                    <span class="screen-reader-text">' . _x( 'Search for:', 'label' ) . '</span>
                    <input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder' ) . '" value="' . get_search_query() . '" name="s" />
                </label>
                <input type="submit" class="search-submit" value="' . esc_attr_x( 'Search', 'submit button' ) . '" />
            </form>';
        } else {
            $form = '<form role="search" ' . $aria_label . 'method="get" id="searchform" class="searchform" action="' . esc_url( home_url( '/' ) ) . '">
                <div>
                    <label class="screen-reader-text" for="s">' . _x( 'Search for:', 'label' ) . '</label>
                    <input type="text" value="' . get_search_query() . '" name="s" id="s" />
                    <input type="submit" id="searchsubmit" value="' . esc_attr_x( 'Search', 'submit button' ) . '" />
                </div>
            </form>';
        }
    }
 
    /**
     * Filters the HTML output of the search form.
     *
     * @since 2.7.0
     * @since 5.5.0 The `$args` parameter was added.
     *
     * @param string $form The search form HTML output.
     * @param array  $args The array of arguments for building the search form.
     *                     See get_search_form() for information on accepted arguments.
     */
    $result = apply_filters( 'get_search_form', $form, $args );
 
    if ( null === $result ) {
        $result = $form;
    }
 
    if ( $args['echo'] ) {
        echo $result;
    } else {
        return $result;
    }
}