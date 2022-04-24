<?php

class EmailFooterMenuWalker extends Walker_Nav_Menu
{
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) 
    {
        $output .= "";
        if( $item->url && $item->url != '#' ) {
            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

            $output .= ' <a ' . $attributes . '" style="font: 400 12px/1 Arial, sans-serif; color: #fff; text-decoration: none;">';
        } else {
            $output .= '<span>';
        }
        $output .= $item->title;
        if( $item->url && $item->url != '#' ) {
            $output .= '</a> ';
        } else {
            $output .= '</span>';
        }
    }

    function end_el( &$output, $item, $depth = 0, $args = array() ) 
    {
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        if( !in_array('is-last', $classes) ) {
            $args->item_separator = '';
        }

        $separator = isset($args->item_separator) ? $args->item_separator : '';
        $output.="{$separator}";
    }
}