<?php
global $wp_rewrite;
global $wp_query;
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;


$paginate_base = get_pagenum_link( 1 );
if ( strpos( $paginate_base, '?' ) || ! $wp_rewrite->using_permalinks() ) {

    $paginate_format = '';
    $paginate_base   = add_query_arg( 'paged', '%#%' );
} else {
    $paginate_format = ( substr( $paginate_base, - 1, 1 ) == '/' ? '' : '/' ) .
        user_trailingslashit( '?paged=%#%/', 'paged' );;
    $paginate_base .= '%_%';
}

echo '<nav aria-label="Page navigation" class="my-3 text-center pagination-block">';
echo paginate_links( array(
    'base'      => $paginate_base,
    'format'    => $paginate_format,
    'total'     => $wp_query->max_num_pages - 1,
    'mid_size'  => 10,
    'current'   => ( $paged ? $paged : 1 ),
    'type'      => '',
    'prev_text' => __( '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
						<path d="M12.6667 8.5L3.33341 8.5" stroke="#00D084" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M8 13.1666L3.33333 8.49996L8 3.83329" stroke="#00D084" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>' ),
    'next_text' => __( '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
						<path d="M3.3335 8.5H12.6668" stroke="#00D084" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M8.00024 3.83337L12.6669 8.50004L8.00024 13.1667" stroke="#00D084" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>' ),
) );
echo "</nav>";
?>
