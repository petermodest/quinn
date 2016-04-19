<div id="sidebar-blockview" class="block-view-post">

	<div class="block-image-state">
		<img src="<?= img_dir() ?>transparent-square.png" />
	</div>

	<div class="inner">
		<h3><a href="/category/backstage/">ABOUT OUR BLOG</a></h3>
		<h3><a href="/blog-list/">OLD SCHOOL VIEW</a></h3>
		
		<div id="sidebar-blockview-divider"></div>
		
		<h3>CATEGORIES</h3>
		<ul><? wp_list_categories( 'title_li=&orderby=name&include=23,24,25' ) ?></ul>
	</div>

</div><!-- #sidebar -->