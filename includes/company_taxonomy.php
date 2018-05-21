<?php
  function wpshout_register_taxonomy() {
    $args = array(
        'hierarchical' => true,
        'label' => 'Companies',
    );
    $labels = array(
        'company_name' => 'Company Name',
        'phone_number' => 'Phone Number'
    );
    register_taxonomy( 'companies', array( 'post', 'page', 'company' ), $args );
  }

// Add term page
function pippin_taxonomy_add_new_meta_field() {
	// this will add the custom meta field to the add new term page
	?>
	<div class="form-field">
		<label for="term_meta[custom_term_meta]"><?php _e( 'Example meta field', 'pippin' ); ?></label>
		<input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" value="">
		<p class="description"><?php _e( 'Enter a value for this field','pippin' ); ?></p>
	</div>
<?php
}
