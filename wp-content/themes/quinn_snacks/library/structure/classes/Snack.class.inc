<?
	class Snack extends Post {

		var $cache = array();
		var $selected = false;
		
		public function __construct( $post = false, $load = true ) {
			if( $post && $load ) $this->load( $post, 1 );
		}
		
		public function load( $post, $taxes = true ) {
			if( is_numeric( $post ) ) :
				$parent = wp_get_post_parent_id( $post );
				if( $parent ) :
					parent::load( $parent, $taxes );
				else :
					parent::load( $post, $taxes );
				endif;
			elseif( $post->post_parent ) :
				$this->cache[ $post->ID ] = new Flavor( $post );
				$this->selected = $post->ID;
				$seo = array(
					'title'			=> $this->cache[ $post->ID ]->seo_title,
					'description'	=> $this->cache[ $post->ID ]->seo_description,
					'keywords'		=> $this->cache[ $post->ID ]->seo_keywords
				);
				
				parent::load( $post->post_parent, $taxes );
				$this->seo_title = $seo['title'];
				$this->seo_description = $seo['description'];
				$this->seo_keywords= $seo['keywords'];
			else :
				parent::load( $post, $taxes );
			endif;			
			
			$this->get_flavors();
		}
		
		public function get_flavors() {
			$children = new WP_Query( array( 'post_type' => 'snack', 'post_parent' => $this->ID ) );
			foreach( $this->get_child_ids() as $key => $child ) :
				$flavor = array_key_exists( $child, $this->cache ) ? new Flavor( $this->cache[$child] ) : new Flavor( $child );
				if( isset( $flavor->retired ) && ! $flavor->retired || ! isset( $flavor->retired ) ) :
					if( ! $this->selected ) :
						$this->selected = $flavor->ID;
					endif;
					$this->flavors[] = $flavor;
				endif;
			endforeach;
		}
		
	}