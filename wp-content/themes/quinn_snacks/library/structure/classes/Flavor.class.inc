<?
	class Flavor extends Post {
		
		public function __construct( $post = false, $load = true ) {
			if( $post && $load ) $this->load( $post, 1 );
		}
		
		public function load( $post, $taxes = true ) {
			parent::load( $post, $taxes );
			
			if( isset( $this->flavor_certifications ) && is_object( $this->flavor_certifications ) && count( (array) $this->flavor_certifications ) > 0 ) :
				foreach( $this->flavor_certifications as $key => $certification ) :
					$this->flavor_certifications->{$key}->image = get_field( 'certification_image', 'certification_' . $certification->term_id );
				endforeach;
			else :
				$this->flavor_certifications = false;
			endif;
			
			if( $this->f2b_featured_supplier ) $this->f2b_featured_supplier = new Supplier( $this->f2b_featured_supplier );
		}
				
	}