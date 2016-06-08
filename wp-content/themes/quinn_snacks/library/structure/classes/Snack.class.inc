<?
	class Snack extends Post {

		var $cache = array();
		var $selected = false;
		var $f2b_section_display = false;
		
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
				$this->seo_keywords = $seo['keywords'];
			else :
				parent::load( $post, $taxes );
			endif;
			
			$this->get_flavors();
		}
		
		public function get_flavors() {
			$children = $this->get_child_ids();
			if( count( $children ) <= 0 ) :
				$children[] = $this->ID;
				$this->parent_flavor = true;
			else :
				$this->parent_flavor = false;
			endif;
			
			foreach( $children as $key => $child ) :
				$flavor = array_key_exists( $child, $this->cache ) ? new Flavor( $this->cache[$child] ) : new Flavor( $child );
				if( ! $flavor->flavor_retired ) :
					if( ! $this->selected ) :
						$this->selected = $flavor->ID;
					endif;
					if( $flavor->f2b_display ) :
						$this->f2b_section_display = true;
					endif;
					$this->flavors[] = $flavor;
				endif;
			endforeach;
		}
		
	}