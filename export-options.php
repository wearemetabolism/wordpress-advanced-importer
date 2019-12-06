<?php

class WP_AdvancedExport {

	/**
	 * Add option choice to export acf options
	 */
	public function addOptions()
	{
		?>
		<fieldset>
			<p><label><input type="radio" name="content" value="options"> Options</label></p>
			<ul id="options-filter" class="export-filters" style="display: block;">
				<li>
					<label><span class="label-responsive">Prefix:</span>
						<input type="text" name="option_filter" placeholder="options_">
					</label>
				</li>
			</ul>
		</fieldset>
		<?php
	}


	/**
	 * Add option choice to export acf options
	 */
	public function exportAddJs()
	{
		?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				var form = $('#export-filters');
				form.find('input:radio').change(function() {
					if( $(this).val() == 'options' )
						setTimeout(function(){ $('#options-filter').stop().slideDown() }, 10);
				});
			});
		</script>
		<?php
	}


	/**
	 * Add option choice to export acf options
	 */
	public function exportArgs($args)
	{
		if ( $_GET['content'] == 'options' ) {
			$args['filter'] = $_GET['option_filter']??'';
		}

		return $args;
	}


	/**
	 * WP_AdvancedExport constructor.
	 */
	public function __construct()
	{
		add_action( 'export_filters', [$this, 'addOptions'] );
		add_action( 'admin_head', [$this, 'exportAddJs'] );
		add_action( 'export_wp', 'advanced_export_wp' );
		add_filter( 'export_args', [$this, 'exportArgs'] );
	}
}

new WP_AdvancedExport();