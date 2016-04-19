<?
	class Flavor extends Post {
		
		public function __construct( $post = false, $load = true ) {
			if( $post && $load ) $this->load( $post, 1 );
		}
		
		public function load( $post, $taxes = true ) {
			parent::load( $post, $taxes );
		}
				
	}