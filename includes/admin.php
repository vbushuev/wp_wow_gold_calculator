<?php
// create custom plugin settings menu
add_action('admin_menu', 'wp_wow_gold_calculator_create_menu');

function wp_wow_gold_calculator_create_menu() {

	//create new top-level menu
	add_menu_page('WoW Gold Calulator Settings', 'WoW Gold Calulator', 'administrator', __FILE__, 'wp_wow_gold_calculator_settings_page' , WP_WOW_GOLD_CALCULATOR_URL.'/img/wow_gold_icon.png' );

	//call register settings function
	add_action( 'admin_init', 'register_wp_wow_gold_calculator_settings' );
}


function register_wp_wow_gold_calculator_settings() {
	//register our settings
	register_setting( 'wow-gold-calculator-settings-group', 'wow_gold_calculator_servers' );
	register_setting( 'wow-gold-calculator-settings-group', 'gold_rate' );
	register_setting( 'wow-gold-calculator-settings-group', 'wow_gold_calculator_agreement_page' );
	register_setting( 'wow-gold-calculator-settings-group', 'wow_gold_calculator_min_order' );

}

function wp_wow_gold_calculator_settings_page() {
	$srvs = get_option('wow_gold_calculator_servers');
	// if(!is_array($srvs)){
		// $srvs = [
		// 	["title"=>"Ясеневый лес","rate"=>100],
		// 	["title"=>"Подземье","rate"=>100],
		// 	["title"=>"Разувий","rate"=>100],
		// 	["title"=>"Ревущий Фьорд","rate"=>100],
		// 	["title"=>"Свежеватель Душ","rate"=>100],
		// 	["title"=>"Седогрив","rate"=>100],
		// 	["title"=>"Страж Смерти","rate"=>100],
		// 	["title"=>"Термоштепсель","rate"=>100],
		// 	["title"=>"Ткач Смерти","rate"=>100],
		// 	["title"=>"Пиратская Бухта","rate"=>100],
		// 	["title"=>"Король лич","rate"=>100],
		// 	["title"=>"Азурегос","rate"=>100],
		// 	["title"=>"Борейская Тундра","rate"=>100],
		// 	["title"=>"Вечная Песня","rate"=>100],
		// 	["title"=>"Галакронд","rate"=>100],
		// 	["title"=>"Голдринн","rate"=>100],
		// 	["title"=>"Гордунни","rate"=>100],
		// 	["title"=>"Гром","rate"=>100],
		// 	["title"=>"Дракономор","rate"=>100],
		// 	["title"=>"Черный Шрам","rate"=>100]
		// ];
		// update_option('wow_gold_calculator_servers',$srvs);
	// }
?>
<div class="wrap">
<h1>WoW Gold Calulator</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'wow-gold-calculator-settings-group' ); ?>
    <?php do_settings_sections( 'wow-gold-calculator-settings-group' ); ?>
	<script>
		function addServer(){
			var s = '<tr valign="top">',i=document.getElementsByClassName("server_row").length, table = document.getElementById("servers");
			s+= '<td scope="row"><input type="text" name="wow_gold_calculator_servers['+i+'][title]" value="" /></td>';
			s+= '<td>цена за 1000 золотых</td>';
	        s+= '<td><input type="text" name="wow_gold_calculator_servers['+i+'][rate]" value="" /></td>';
	        s+= '</tr>';
			table.innerHTML = table.innerHTML + s;
		}
		function deleteServer(i){
			var srv = document.getElementById('server_'+i);
			srv.parentNode.removeChild(srv);
		}
	</script>
    <table class="form-table" id="servers">
		<tr>
			<th colspan="4"><button type="button" class="button button-primary" onclick="addServer();">Добавить сервер</button></th>
		</tr>
		<tr>
			<th>Сервер</th>
			<th>Валюта</th>
			<th colspan="3">Курс (&#8381;)</th>
		</tr>
		<?php for($i=0;$i<count($srvs);++$i){
			echo '<tr valign="top" class="server_row" id="server_'.$i.'">';
	        echo '<td scope="row"><input type="text" name="wow_gold_calculator_servers['.$i.'][title]" value="'.$srvs[$i]['title'].'" /></td>';
			echo '<td><select name="wow_gold_calculator_servers['.$i.'][currency]"><option value="gold"'.(($srvs[$i]['currency']=="gold")?' selected="selected"':'').'>1000 Золотых</option><option value="saronit"'.(($srvs[$i]['currency']=="saronit")?' selected="selected"':'').'>1 Древнейший саронит</option></select></td>';
	        echo '<td><input type="text" name="wow_gold_calculator_servers['.$i.'][rate]" value="'.$srvs[$i]['rate'].'" /></td>';
	        echo '<td><button type="button" onclick="deleteServer('.$i.')">Удалить</button></td>';
	        echo '</tr>';
		} ?>
        <!-- <tr valign="top">
        <th scope="row">Кол-во золота за 1 руб.</th>
        <td><input type="text" name="gold_rate" value="<?php echo esc_attr( get_option('gold_rate') ); ?>" /></td>
        </tr> -->
	</table>
	<hr />
	<table class="form-table">
        <tr valign="top">
        <th scope="row">Минимальная сумма заказа (руб.)</th>
        <td><input type="text" name="wow_gold_calculator_min_order" value="<?php echo esc_attr( get_option('wow_gold_calculator_min_order') ); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Страница с условиями соглашения</th>
        <td><input type="text" name="wow_gold_calculator_agreement_page" value="<?php echo esc_attr( get_option('wow_gold_calculator_agreement_page') ); ?>" /></td>
        </tr>

        <!-- <tr valign="top">
        <th scope="row">Options, Etc.</th>
        <td><input type="text" name="option_etc" value="<?php echo esc_attr( get_option('option_etc') ); ?>" /></td>
        </tr> -->
    </table>

    <?php submit_button(); ?>

</form>
</div>
<?php } ?>
<?php

/* register menu item */
function wp_wow_gold_calculator_admin_menu_setup() {
    add_submenu_page(
        'options-general.php',
        'WowGoldCalculator Settings',
        'WoWGoldCalculator',
        'manage_options',
        'wp_wow_gold_calculator',
        'wp_wow_gold_calculator_admin_page_screen'
    );
}
//menu setup
add_action('admin_menu', 'wp_wow_gold_calculator_admin_menu_setup');

/* display page content */
function wp_wow_gold_calculator_admin_page_screen() {
    global $submenu;

    // access page settings
    $page_data = array();

    foreach ($submenu['options-general.php'] as $i => $menu_item) {
        if ($submenu['options-general.php'][$i][2] == 'wp_wow_gold_calculator') {
            $page_data = $submenu['options-general.php'][$i];
        }
    }
    // output
?>
    <div class="wrap">
        <?php screen_icon(); ?>
        <h2><?php echo $page_data[3]; ?></h2>
        <form id="wp_wow_gold_calculator_options" action="options.php" method="post">
            <?php
            settings_fields('wp_wow_gold_calculator_options');
            do_settings_sections('wp_wow_gold_calculator');
            submit_button('Save options', 'primary', 'wp_wow_gold_calculator_options_submit');
            ?>
        </form>
    </div>
    <?php
}

/* settings link in plugin management screen */

function wp_wow_gold_calculator_settings_link($actions, $file) {
    if (false !== strpos($file, 'WoWGoldCalculator')) {
        $actions['settings'] = '<a href="options-general.php?page=wp_wow_gold_calculator">Settings</a>';
    }

    return $actions;
}

add_filter('plugin_action_links', 'wp_wow_gold_calculator_settings_link', 2, 2);

/* регистрация настроек в системе */
function wp_wow_gold_calculator_settings_init() {
    register_setting(
        'wp_wow_gold_calculator_options',
        'wp_wow_gold_calculator_options',
        'wp_wow_gold_calculator_options_validate'
    );

    add_settings_section(
        'wp_wow_gold_calculator_authorbox',
        'Author\'s box',
        'wp_wow_gold_calculator_authorbox_desc',
        'wp_wow_gold_calculator'
    );

    add_settings_field(
        'wp_wow_gold_calculator_authorbox_template',
        'Template',
        'wp_wow_gold_calculator_authorbox_field',
        'wp_wow_gold_calculator',
        'wp_wow_gold_calculator_authorbox'
    );
}

add_action('admin_init', 'wp_wow_gold_calculator_settings_init');

/* обработка ввода */

function wp_wow_gold_calculator_options_validate($input) {
    global $allowedposttags, $allowedrichhtml;

    if (isset($input['authorbox_template'])) {
        $input['authorbox_template'] = wp_kses_post($input['authorbox_template']);
    }

    return $input;
}

/* описание */

function wp_wow_gold_calculator_authorbox_desc() {
    echo "<p>Enter the template markup for author box using placeholders: [gauthor_name], [gauthor_url], [gauthor_desc] for name, URL and description of author correspondingly.</p>";
}

/* вывод полей */

function wp_wow_gold_calculator_authorbox_field() {
    $options = get_option('wp_wow_gold_calculator_options');
    $authorbox = (isset($options['authorbox_template'])) ? $options['authorbox_template'] : '';
    $authorbox = esc_textarea($authorbox);
?>
    <textarea id="authorbox_template" name="wp_wow_gold_calculator_options[authorbox_template]" cols="50" rows="5" class="large-text code">
    <?php echo $authorbox; ?>
    </textarea>
<?php
}
