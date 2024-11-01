<?php  
/* 
Plugin Name: Universal Accessibility Key (UAK)
Plugin URI: http://uak.itchiweb.com
Version: 0.1
Author: Itchiweb.com
License: GNU General Public License, version 2
Description: Open a special accessibility page/website for SHIFT+A / Ajoute le raccourci accessibilité MAJ+A
*/  

add_action('admin_menu', 'uak_plugin_settings');
function uak_plugin_settings() {
    add_options_page('UAK Universal Accessibility Key', 'UAK', 'administrator', 'uak_settings', 'uak_display_settings');
}

// add hk
function uak_scripts()
{
    // Register the script like this for a plugin:
    wp_register_script( 'uak-script', plugins_url( '/js/uak.min.js', __FILE__ ), array( 'jquery' ) );
	// For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script( 'uak-script', array( 'jquery' ) );
	wp_localize_script('uak-script', 'uak_script_vars', array(
			'url' => get_option('accessible_url')
		)
	);
}
add_action( 'wp_enqueue_scripts', 'uak_scripts' );

function uak_display_settings() {

    $accessible_url = (get_option('accessible_url') != '') ? get_option('accessible_url') : 'http://some.accessible.page/';
    $html = '<div class="wrap">
			<div>
				<a href="http://uak.itchiweb.com" target="_blank"><img src="'.plugins_url( '/img/uak-settings-banner.png', __FILE__ ).'"></a>
		        <h1>Universal Accessibility Key (UAK)</h1>
	            <h2>Raccourci clavier universel "Accessibilité"</h2>
	            <p>L\'utilisateur sera redirigé vers l\'URL ci-dessous lorsqu\'il utilisera le raccourci clavier MAJUSCULE + A</p>
			</div>
            <form method="post" name="options" action="options.php">
            ' . wp_nonce_field('update-options') . '
            <table width="100%" cellpadding="10" class="form-table">
                <tr>
                    <td align="left" scope="row">
                    <label>URL de la page ou du site accessible : </label><input style="width:300px" type="text" name="accessible_url" 
                    value="' . $accessible_url . '" />
                    </td> 
                </tr>
            </table>
            <p class="submit">
                <input type="hidden" name="action" value="update" />  
                <input type="hidden" name="page_options" value="fwds_autoplay,fwds_effect,accessible_url,fwds_playBtn" /> 
                <input class="button" type="submit" name="Submit" value="Update" />
            </p>
            </form>
			<div>
				<a style="float:left;padding:0 15px 0 0px" href="http://itchikai.itchiweb.com" target="_blank"><img src="'.plugins_url( '/img/logo_min.png', __FILE__ ).'"></a>
				Concept : <a href="http://uak.itchiweb.com" target="_blank">http://uak.itchiweb.com</a><br />
				Kit accessibilité internet multi-publics Itchikai : <a href="http://itchikai.itchiweb.com" target="_blank">http://itchikai.itchiweb.com</a><br /><br />			
			</div>
        </div>';
    echo $html;
}
?>