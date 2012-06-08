<?php
    /**
     * OSClass – software for creating and publishing online classified advertising platforms
     *
     * Copyright (C) 2010 OSCLASS
     *
     * This program is free software: you can redistribute it and/or modify it under the terms
     * of the GNU Affero General Public License as published by the Free Software Foundation,
     * either version 3 of the License, or (at your option) any later version.
     *
     * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
     * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
     * See the GNU Affero General Public License for more details.
     *
     * You should have received a copy of the GNU Affero General Public
     * License along with this program. If not, see <http://www.gnu.org/licenses/>.
     */


    //customize Head
    function customHead(){
        ?>
        <script type="text/javascript" src="<?php echo osc_current_admin_theme_js_url('jquery.validate.min.js') ; ?>"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                // Code for form validation
                $("form[name=currency_form]").validate({
                    rules: {
                        pk_c_code: {
                            required: true,
                            minlength: 3,
                            maxlength: 3
                        },
                        s_name: {
                            required: true,
                            minlength: 1
                        }
                    },
                    messages: {
			pk_c_code: {
				required: "<?php echo osc_esc_js( __('Currency code: this field is required')); ?>.",
				minlength: "<?php echo osc_esc_js( __('Currency code: this field is required')); ?>.",
				maxlength: "<?php echo osc_esc_js( __('Currency code: this field is required')); ?>."
			},
			s_name: {
				required: "<?php echo osc_esc_js( __('Name: this field is required')); ?>.",
				minlength: "<?php echo osc_esc_js( __('Name: this field is required')); ?>."
			}
                    },
                    wrapper: "li",
                    errorLabelContainer: "#error_list",
                    invalidHandler: function(form, validator) {
                        $('html,body').animate({ scrollTop: $('h1').offset().top }, { duration: 250, easing: 'swing'});
                    }
                });
            });
        </script>
        <?php
    }
    osc_add_hook('admin_header','customHead');

    osc_add_hook('admin_page_header','customPageHeader');
    function customPageHeader(){ ?>
        <h1><?php _e('Currencies') ; ?>
            <a href="#" class="btn ico ico-32 ico-help float-right"></a>
            <a href="<?php echo osc_admin_base_url(true).'?page=settings&action=currencies&type=add'; ?>" class="btn btn-green ico ico-32 ico-add-white float-right"><?php _e('Add'); ?></a>
	</h1>
    <?php
    }
    
    $aCurrency = View::newInstance()->_get('aCurrency') ;
     $typeForm  = View::newInstance()->_get('typeForm') ;

     if( $typeForm == 'add_post' ) {
         $title  = __('Add Currency') ;
         $submit = osc_esc_html( __('Add new currency') ) ;
     } else {
         $title  = __('Edit Currency') ;
         $submit = osc_esc_html( __('Update') ) ;
     }
     
?>
<?php osc_current_admin_theme_path( 'parts/header.php' ) ; ?>

<div id="add-currency-settings">
    <h2 class="render-title"><?php _e('Add currency') ; ?></h2>
    <ul id="error_list" style="display: none;"></ul>
    <form name="currency_form" action="<?php echo osc_admin_base_url(true) ; ?>" method="post">
        <input type="hidden" name="page" value="settings" />
        <input type="hidden" name="action" value="currencies" />
        <input type="hidden" name="type" value="<?php echo $typeForm ; ?>" />
        <?php if( $typeForm == 'edit_post' ) { ?>
        <input type="hidden" name="pk_c_code" value="<?php echo osc_esc_html($aCurrency['pk_c_code']) ; ?>" />
        <?php } ?>
        <fieldset>
        <div class="form-horizontal">
        <div class="form-row">
            <div class="form-label"><?php _e('Currency Code'); ?></div>
            <div class="form-controls">
                <input type="text" class="input-small" name="pk_c_code" value="<?php echo osc_esc_html($aCurrency['pk_c_code']) ; ?>" <?php if( $typeForm == 'edit_post' ) echo 'disabled="disabled"' ; ?> />
                <span class="help-box"><?php _e('It should be a three-character code') ; ?></span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label"><?php _e('Name') ; ?></div>
            <div class="form-controls">
                <input type="text" class="input-large" name="s_name" value="<?php echo osc_esc_html($aCurrency['s_name']) ; ?>" />
            </div>
        </div>
        <div class="form-row">
            <div class="form-label"><?php _e('Description') ; ?></div>
            <div class="form-controls">
                <input type="text" class="input-large" name="s_description" value="<?php echo osc_esc_html($aCurrency['s_description']) ; ?>" />
            </div>
        </div>
        <div class="form-actions">
            <?php if( $typeForm == 'edit_post' ) { ?>
            <input class="btn btn-red" type="button" value="Cancel" onclick="location.href='http://demo.osclass.org/cars/oc-admin/index.php?page=settings&amp;action=currencies'">
            <?php } ?>
            <input type="submit" value="<?php echo osc_esc_html( __('Save changes') ) ; ?>" class="btn btn-submit" />
        </div>
    </div>
    </fieldset>
</form>
</div>
<!-- /settings form -->
<?php osc_current_admin_theme_path( 'parts/footer.php' ) ; ?>                