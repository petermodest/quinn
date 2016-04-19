<?
	// 	CUSTOM POST TYPE AND THEME CLASSES
	foreach( scandir( get_stylesheet_directory() . '/library/structure/classes' ) as $filename ) :
		if( ! in_array( $filename, array( '.', '..', '.DS_Store' ) ) ) require_once( get_stylesheet_directory() . '/library/structure/classes/' . $filename );
	endforeach;
