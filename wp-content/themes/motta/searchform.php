<?php
/**
 * default search form
 */
?>
<form role="search" method="get" id="search-form" class="menu__search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="search-wrap">
        <input type="search" placeholder="<?php echo esc_attr( 'Search…', 'presentation' ); ?>" name="s" id="search-input" value="<?php echo esc_attr( get_search_query() ); ?>">

            <button class="" type="submit" id="search-submit" value="">
            <span class="fa fa-search" aria-hidden="true"></span></button>

    </div>
</form>
