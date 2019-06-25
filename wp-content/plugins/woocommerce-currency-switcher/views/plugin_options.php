<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="woocs-admin-preloader"></div>

<div class="subsubsub_section">
    <br class="clear" />

    <?php
    global $WOOCS;

    $welcome_curr_options = array();
    if (!empty($currencies) AND is_array($currencies)) {
        foreach ($currencies as $key => $currency) {
            $welcome_curr_options[$currency['name']] = $currency['name'];
        }
    }
    //+++
    $pd = array();
    $countries = array();
    if (class_exists('WC_Geolocation')) {
        $c = new WC_Countries();
        $countries = $c->get_countries();
        $pd = WC_Geolocation::geolocate_ip();
    }
    //+++
    $options = array(
        array(
            'name' => '',
            'type' => 'title',
            'desc' => '',
            'id' => 'woocs_general_settings'
        ),
        array(
            'name' => esc_html__('Drop-down view', 'woocommerce-currency-switcher'),
            'desc' => esc_html__('How to display currency switcher drop-down on the front of your site', 'woocommerce-currency-switcher'),
            'id' => 'woocs_drop_down_view',
            'type' => 'select',
            'class' => 'chosen_select',
            'css' => 'min-width:300px;',
            'options' => array(
                'ddslick' => esc_html__('ddslick', 'woocommerce-currency-switcher'),
                'chosen' => esc_html__('chosen', 'woocommerce-currency-switcher'),
                'chosen_dark' => esc_html__('chosen dark', 'woocommerce-currency-switcher'),
                'wselect' => esc_html__('wSelect', 'woocommerce-currency-switcher'),
                'no' => esc_html__('simple drop-down', 'woocommerce-currency-switcher'),
                'flags' => esc_html__('show as flags', 'woocommerce-currency-switcher'),
            ),
            'desc_tip' => true
        ),
        array(
            'name' => esc_html__('Show flags by default', 'woocommerce-currency-switcher'),
            'desc' => esc_html__('Show/hide flags on the front drop-down', 'woocommerce-currency-switcher'),
            'id' => 'woocs_show_flags',
            'type' => 'select',
            'class' => 'chosen_select',
            'css' => 'min-width:300px;',
            'options' => array(
                0 => esc_html__('No', 'woocommerce-currency-switcher'),
                1 => esc_html__('Yes', 'woocommerce-currency-switcher')
            ),
            'desc_tip' => true
        ),
        array(
            'name' => esc_html__('No GET data in link', 'woocommerce-currency-switcher'),
            'desc' => esc_html__('Switches currency without GET properties (?currency=USD) in the link. Works in woocommerce > 3.3.0.', 'woocommerce-currency-switcher'),
            'id' => 'woocs_special_ajax_mode',
            'type' => 'select',
            'class' => 'chosen_select',
            'css' => 'min-width:300px;',
            'options' => array(
                0 => esc_html__('No', 'woocommerce-currency-switcher'),
                1 => esc_html__('Yes', 'woocommerce-currency-switcher')
            ),
            'desc_tip' => true
        ),
        array(
            'name' => esc_html__('Show money signs', 'woocommerce-currency-switcher'),
            'desc' => esc_html__('Show/hide money signs on the front drop-down', 'woocommerce-currency-switcher'),
            'id' => 'woocs_show_money_signs',
            'type' => 'select',
            'class' => 'chosen_select',
            'css' => 'min-width:300px;',
            'options' => array(
                0 => esc_html__('No', 'woocommerce-currency-switcher'),
                1 => esc_html__('Yes', 'woocommerce-currency-switcher')
            ),
            'desc_tip' => true
        ),
        array(
            'name' => esc_html__('Show price info icon', 'woocommerce-currency-switcher'),
            'desc' => esc_html__('Show info icon near the price of the product which while its under hover shows prices of products in all currencies', 'woocommerce-currency-switcher'),
            'id' => 'woocs_price_info',
            'type' => 'select',
            'class' => 'chosen_select',
            'css' => 'min-width:300px;',
            'options' => array(
                0 => esc_html__('No', 'woocommerce-currency-switcher'),
                1 => esc_html__('Yes', 'woocommerce-currency-switcher')
            ),
            'desc_tip' => true
        ),
        array(
            'name' => esc_html__('Welcome currency', 'woocommerce-currency-switcher'),
            'desc' => esc_html__('In wich currency show prices for first visit of your customer on your site', 'woocommerce-currency-switcher'),
            'id' => 'woocs_welcome_currency',
            'type' => 'select',
            'class' => 'chosen_select',
            'css' => 'min-width:300px;',
            'options' => $welcome_curr_options,
            'desc_tip' => true
        ),
        array(
            'name' => esc_html__('Currency aggregator', 'woocommerce-currency-switcher'),
            'desc' => esc_html__('Currency aggregators. Note: XE Currency Converter doesnt work with crypto-currency such as BTC!', 'woocommerce-currency-switcher'),
            'id' => 'woocs_currencies_aggregator',
            'type' => 'select',
            'class' => 'chosen_select',
            'css' => 'min-width:300px;',
            'options' => array(
                'yahoo' => 'www.finance.yahoo.com',
//                'google' => 'www.google.com/finance',
                'ecb' => 'www.ecb.europa.eu',
                'free_ecb' => 'The Free Currency Converter by European Central Bank',
                'micro' => 'Micro pyramid',
                'rf' => 'www.cbr.ru - russian centrobank',
                'privatbank' => 'api.privatbank.ua - ukrainian privatbank',
                'bank_polski' => 'Narodowy Bank Polsky',
                'free_converter' => 'The Free Currency Converter',
                'fixer' => 'Fixer',
                'cryptocompare' => 'CryptoCompare',
            ),
            'desc_tip' => true
        ),
        array(
            'name' => esc_html__('Aggregator API key', 'woocommerce-currency-switcher'),
            'desc' => esc_html__('Some aggregators require an API key. See the hint below how to get it!', 'woocommerce-currency-switcher'),
            'id' => 'woocs_aggregator_key',
            'type' => 'text',
            'std' => '', // WooCommerce < 2.0
            'default' => '', // WooCommerce >= 2.0
            'css' => 'min-width:300px;',
            'desc_tip' => true
        ),
        array(
            'name' => esc_html__('Currency storage', 'woocommerce-currency-switcher'),
            'desc' => esc_html__('In some servers there is troubles with sessions, and after currency selecting its reset to welcome currency or geo ip currency. In such case use transient!', 'woocommerce-currency-switcher'),
            'id' => 'woocs_storage',
            'type' => 'select',
            'class' => 'chosen_select',
            'css' => 'min-width:300px;',
            'options' => array(
                'session' => esc_html__('session', 'woocommerce-currency-switcher'),
                'transient' => esc_html__('transient', 'woocommerce-currency-switcher')
            ),
            'desc_tip' => true
        ),
        array(
            'name' => esc_html__('Rate auto update', 'woocommerce-currency-switcher'),
            'desc' => esc_html__('Currencies rate auto update by WordPress cron.', 'woocommerce-currency-switcher'),
            'id' => 'woocs_currencies_rate_auto_update',
            'type' => 'select',
            'class' => 'chosen_select',
            'css' => 'min-width:300px;',
            'options' => array(
                'no' => esc_html__('no auto update', 'woocommerce-currency-switcher'),
                'hourly' => esc_html__('hourly', 'woocommerce-currency-switcher'),
                'twicedaily' => esc_html__('twicedaily', 'woocommerce-currency-switcher'),
                'daily' => esc_html__('daily', 'woocommerce-currency-switcher'),
                'week' => esc_html__('weekly', 'woocommerce-currency-switcher'),
                'month' => esc_html__('monthly', 'woocommerce-currency-switcher'),
                'min1' => esc_html__('special: each minute', 'woocommerce-currency-switcher'), //for tests
                'min5' => esc_html__('special: each 5 minutes', 'woocommerce-currency-switcher'), //for tests
                'min15' => esc_html__('special: each 15 minutes', 'woocommerce-currency-switcher'), //for tests
                'min30' => esc_html__('special: each 30 minutes', 'woocommerce-currency-switcher'), //for tests
                'min45' => esc_html__('special: each 45 minutes', 'woocommerce-currency-switcher'), //for tests
            ),
            'desc_tip' => true
        ),
        array(
            'name' => esc_html__('Email notice about "Rate auto update" results', 'woocommerce-currency-switcher'),
            'desc' => esc_html__('After cron done - new currency rates will be sent on the site admin email. ATTENTION: if you not got emails - it is mean that PHP function mail() doesnt work on your server or sending emails by this function is locked.', 'woocommerce-currency-switcher'),
            'id' => 'woocs_rate_auto_update_email',
            'type' => 'select',
            'class' => 'chosen_select',
            'css' => 'min-width:300px;',
            'options' => array(
                0 => esc_html__('No', 'woocommerce-currency-switcher'),
                1 => esc_html__('Yes', 'woocommerce-currency-switcher'),
            ),
            'desc_tip' => true
        ),
        array(
            'name' => esc_html__('Hide switcher on checkout page', 'woocommerce-currency-switcher'),
            'desc' => esc_html__('Hide switcher on checkout page for any of your reason. Better restrike for users change currency on checkout page in multiple mode.', 'woocommerce-currency-switcher'),
            'id' => 'woocs_restrike_on_checkout_page',
            'type' => 'select',
            'class' => 'chosen_select',
            'css' => 'min-width:300px;',
            'options' => array(
                0 => esc_html__('No', 'woocommerce-currency-switcher'),
                1 => esc_html__('Yes', 'woocommerce-currency-switcher'),
            ),
            'desc_tip' => true
        ),
        array(
            'name' => esc_html__('Payments rules', 'woocommerce-currency-switcher'),
            'desc' => esc_html__('Hide/Show payments systems on checkout page depending on the current currency', 'woocommerce-currency-switcher'),
            'id' => 'woocs_payments_rule_enabled',
            'type' => 'select',
            'class' => 'chosen_select',
            'css' => 'min-width:300px;',
            'options' => array(
                0 => esc_html__('No', 'woocommerce-currency-switcher'),
                1 => esc_html__('Yes', 'woocommerce-currency-switcher'),
            ),
            'desc_tip' => true
        ),
        array(
            'name' => esc_html__('Show approx. amount', 'woocommerce-currency-switcher'),
            'desc' => esc_html__('Show approximate amount on the checkout and the cart page with currency of user defined by IP in the GeoIp rules tab. Works only with currencies rates data and NOT with fixed prices rules and geo rules.', 'woocommerce-currency-switcher'),
            'id' => 'woocs_show_approximate_amount',
            'type' => 'select',
            'class' => 'chosen_select',
            'css' => 'min-width:300px;',
            'options' => array(
                0 => esc_html__('No', 'woocommerce-currency-switcher'),
                1 => esc_html__('Yes', 'woocommerce-currency-switcher'),
            ),
            'desc_tip' => true
        ),
        array(
            'name' => esc_html__('Show approx. price', 'woocommerce-currency-switcher'),
            'desc' => esc_html__('Show approximate price on the shop and the single product page with currency of user defined by IP in the GeoIp rules tab. Works only with currencies rates data and NOT with fixed prices rules and geo rules.', 'woocommerce-currency-switcher'),
            'id' => 'woocs_show_approximate_price',
            'type' => 'select',
            'class' => 'chosen_select',
            'css' => 'min-width:300px;',
            'options' => array(
                0 => esc_html__('No', 'woocommerce-currency-switcher'),
                1 => esc_html__('Yes', 'woocommerce-currency-switcher'),
            ),
            'desc_tip' => true
        ),
        array(
            'name' => esc_html__('I am using cache plugin on my site', 'woocommerce-currency-switcher'),
            'desc' => esc_html__('Set Yes here ONLY if you are REALLY use cache plugin for your site, for example like Super cache or Hiper cache (doesn matter). + Set "Custom price format", for example: __PRICE__ (__CODE__). After enabling this feature - clean your cache to make it works. It will allow show prices in selected currency on all pages of site. Fee for this feature - additional AJAX queries for products prices redrawing.', 'woocommerce-currency-switcher'),
            'id' => 'woocs_shop_is_cached',
            'type' => 'select',
            'class' => 'chosen_select',
            'css' => 'min-width:300px;',
            'options' => array(
                0 => esc_html__('No', 'woocommerce-currency-switcher'),
                1 => esc_html__('Yes', 'woocommerce-currency-switcher'),
            ),
            'desc_tip' => true
        ),
        array(
            'name' => esc_html__('Custom money signs', 'woocommerce-currency-switcher'),
            'desc' => esc_html__('Add your money symbols in your shop. Example: $USD,AAA,AUD$,DDD - separated by commas', 'woocommerce-currency-switcher'),
            'id' => 'woocs_customer_signs',
            'type' => 'textarea',
            'std' => '', // WooCommerce < 2.0
            'default' => '', // WooCommerce >= 2.0
            'css' => 'min-width:500px;',
            'desc_tip' => true
        ),
        array(
            'name' => esc_html__('Custom price format', 'woocommerce-currency-switcher'),
            'desc' => esc_html__('Set your format how to display price on front. Use keys: __CODE__,__PRICE__. Leave it empty to use default format. Example: __PRICE__ (__CODE__)', 'woocommerce-currency-switcher'),
            'id' => 'woocs_customer_price_format',
            'type' => 'text',
            'std' => '', // WooCommerce < 2.0
            'default' => '', // WooCommerce >= 2.0
            'css' => 'min-width:500px;',
            'desc_tip' => true
        ),
        array(
            'name' => esc_html__('Prices without cents', 'woocommerce-currency-switcher'),
            'desc' => esc_html__('Recount prices without cents everywhere like in JPY and TWD which by its nature have not cents. Use comma. Example: UAH,RUB. Test it for checkout after setup!', 'woocommerce-currency-switcher'),
            'id' => 'woocs_no_cents',
            'type' => 'text',
            'std' => '', // WooCommerce < 2.0
            'default' => '', // WooCommerce >= 2.0
            'css' => 'min-width:500px;',
            'desc_tip' => true
        ),
        array('type' => 'sectionend', 'id' => 'woocs_general_settings')
    );
    $woocs_is_payments_rule_enable = get_option('woocs_payments_rule_enabled', 0);
    ?>


    <div class="section">

        <h3 class="woocs_settings_version"><?php printf(esc_html__('WooCommerce Currency Switcher v.%s', 'woocommerce-currency-switcher'), WOOCS_VERSION) ?></h3>
        <i><?php printf(esc_html__('Actualized for WooCommerce v.%s.x', 'woocommerce-currency-switcher'), $this->actualized_for) ?></i><br />

        <br />

        <div id="tabs" class="wfc-tabs wfc-tabs-style-shape" >

            <?php if (version_compare(WOOCOMMERCE_VERSION, WOOCS_MIN_WOOCOMMERCE, '<')): ?>

                <b class="woocs_settings_version" ><?php printf(esc_html__("Your version of WooCommerce plugin is too obsolete. Update minimum to %s version to avoid malfunctionality!", 'woocommerce-currency-switcher'), WOOCS_MIN_WOOCOMMERCE) ?></b><br />

            <?php endif; ?>

            <input type="hidden" name="woocs_woo_version" value="<?php echo WOOCOMMERCE_VERSION ?>" />

            <svg class="hidden">
            <defs>
            <path id="tabshape" d="M80,60C34,53.5,64.417,0,0,0v60H80z"/>
            </defs>
            </svg><nav>
                <ul>
                    <li class="tab-current">
                        <a href="#tabs-1">
                            <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                            <span><?php esc_html_e("Currencies", 'woocommerce-currency-switcher') ?></span>
                        </a>
                    </li><li>
                        <a href="#tabs-2">
                            <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                            <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                            <span><?php esc_html_e("Options", 'woocommerce-currency-switcher') ?></span>
                        </a>
                    </li><li><a href="#tabs-3">
                            <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                            <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                            <span><?php esc_html_e("Advanced", 'woocommerce-currency-switcher') ?></span>
                        </a></li>
                    <?php if (version_compare($WOOCS->actualized_for, '3.3', '>=')): ?>
                        <li>
                            <a href="#tabs-6">
                                <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                                <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                                <span><?php esc_html_e("Side switcher", 'woocommerce-currency-switcher') ?></span>
                            </a>
                        </li>

                        <?php if ($woocs_is_payments_rule_enable): ?>    
                            <li>
                                <a href="#tabs-7">
                                    <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                                    <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                                    <span><?php esc_html_e("Payments rules", 'woocommerce-currency-switcher') ?></span>
                                </a>
                            </li>  
                        <?php endif; ?>  

                    <?php endif; ?>
                    <?php if ($this->is_use_geo_rules()): ?>
                        <li>
                            <a href="#tabs-4">
                                <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                                <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                                <span><?php esc_html_e("GeoIP rules", 'woocommerce-currency-switcher') ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <a href="#tabs-5">
                            <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                            <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                            <span><?php esc_html_e("Info Help", 'woocommerce-currency-switcher') ?></span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="content-wrap">
                <section id="tabs-1" class="content-current">
                    <div class="wcf-control-section">
                        <a href="#" id="woocs_add_currency" class="dashicons-before dashicons-plus"><?php esc_html_e("Add Currency", 'woocommerce-currency-switcher') ?></a><br />

                        <div class="woocs_settings_hide">
                            <div id="woocs_item_tpl"><?php
                                $empty = array(
                                    'name' => '',
                                    'rate' => 0,
                                    'symbol' => '',
                                    'position' => '',
                                    'is_etalon' => 0,
                                    'description' => '',
                                    'hide_cents' => 0
                                );
                                woocs_print_currency($this, $empty);
                                ?>
                            </div>
                        </div>

                        <ul id="woocs_list">
                            <?php
                            if (!empty($currencies) AND is_array($currencies)) {
                                foreach ($currencies as $key => $currency) {
                                    woocs_print_currency($this, $currency);
                                }
                            }
                            ?>
                        </ul>

                        <div class="woocs_settings_codes">
                            <a href="http://en.wikipedia.org/wiki/ISO_4217#Active_codes" target="_blank" class="button button-primary button-large"><?php esc_html_e("Read wiki about Currency Active codes  <-  Get right currencies codes here if you are not sure about it!", 'woocommerce-currency-switcher') ?></a>
                        </div>

                        <div class="woocs_settings_clear"></div>

                    </div>
                </section>
                <section id="tabs-2">
                    <div class="wfc-control-section-xxx">
                        <?php woocommerce_admin_fields($options); ?>
                    </div>
                </section>

                <section id="tabs-3">

                    <table class="form-table">
                        <tbody>
                            <tr valign="top">
                                <th scope="row" class="titledesc">
                                    <label for="woocs_is_multiple_allowed"><?php esc_html_e('Is multiple allowed', 'woocommerce-currency-switcher') ?></label>
                                    <span class="woocommerce-help-tip" data-tip="<?php esc_html_e('Customer will pay with selected currency (Yes) or with default currency (No).', 'woocommerce-currency-switcher') ?>"></span>
                                </th>
                                <td class="forminp forminp-select">
                                    <?php
                                    $opts = array(
                                        0 => esc_html__('No', 'woocommerce-currency-switcher'),
                                        1 => esc_html__('Yes', 'woocommerce-currency-switcher')
                                    );
                                    $woocs_is_multiple_allowed = get_option('woocs_is_multiple_allowed', 0);
                                    ?>
                                    <select name="woocs_is_multiple_allowed" id="woocs_is_multiple_allowed" class="chosen_select enhanced woocs_settings_dd" tabindex="-1" title="<?php esc_html_e('Is multiple allowed', 'woocommerce-currency-switcher') ?>">

                                        <?php foreach ($opts as $val => $title): ?>
                                            <option value="<?php echo $val ?>" <?php echo selected($woocs_is_multiple_allowed, $val) ?>><?php echo $title ?></option>
                                        <?php endforeach; ?>

                                    </select>
                                </td>
                            </tr>

                            <tr valign="top" class="<?php if (!$woocs_is_multiple_allowed): ?>woocs_settings_hide<?php endif; ?>" >
                                <th scope="row" class="titledesc">
                                    <label for="woocs_is_fixed_enabled"><?php esc_html_e('Individual fixed prices rules for each product', 'woocommerce-currency-switcher') ?>(*)</label>
                                    <span class="woocommerce-help-tip woocs_settings_tip"  data-tip="<?php esc_html_e("You will be able to set FIXED prices for simple and variable products. ATTENTION: 'Is multiple allowed' should be enabled!", 'woocommerce-currency-switcher') ?>"></span>
                                </th>
                                <td class="forminp forminp-select">
                                    <?php
                                    $opts = array(
                                        0 => esc_html__('No', 'woocommerce-currency-switcher'),
                                        1 => esc_html__('Yes', 'woocommerce-currency-switcher')
                                    );
                                    $woocs_is_fixed_enabled = get_option('woocs_is_fixed_enabled', 0);
                                    ?>
                                    <select name="woocs_is_fixed_enabled" id="woocs_is_fixed_enabled"  class="chosen_select enhanced woocs_settings_dd" tabindex="-1" title="<?php esc_html_e('Enable fixed pricing', 'woocommerce-currency-switcher') ?>">

                                        <?php foreach ($opts as $val => $title): ?>
                                            <option value="<?php echo $val ?>" <?php echo selected($woocs_is_fixed_enabled, $val) ?>><?php echo $title ?></option>
                                        <?php endforeach; ?>

                                    </select>&nbsp;<a href="https://currency-switcher.com/video-tutorials#video_YHDQZG8GS6w" target="_blank" class="button"><?php esc_html_e('Watch video instructions', 'woocommerce-currency-switcher') ?></a>
                                </td>
                            </tr>


                            <tr valign="top" class="<?php if (!$woocs_is_fixed_enabled): ?>woocs_settings_hide<?php endif; ?>" >
                                <th scope="row" class="titledesc">
                                    <label for="woocs_force_pay_bygeoip_rules"><?php esc_html_e('Checkout by GeoIP rules', 'woocommerce-currency-switcher') ?></label>
                                    <span class="woocommerce-help-tip woocs_settings_geo_tip" data-tip="<?php esc_html_e("Force the customers to pay on checkout page by rules defined in 'GeoIP rules' tab. <b>ATTENTION</b>: this feature has logical sense if you enabled 'Enable fixed pricing' and also installed fixed prices rules in the products for different currencies!", 'woocommerce-currency-switcher') ?>"></span>
                                    <?php
                                    if (!empty($pd) AND ! empty($countries) AND isset($countries[$pd['country']])) {
                                        echo '<i class="woocs_settings_i1" >' . sprintf(esc_html__('Your country is: %s', 'woocommerce-currency-switcher'), $countries[$pd['country']]) . '</i>';
                                    } else {
                                        echo '<i class="woocs_settings_i2" >' . esc_html__('Your country is not defined! Troubles with internet connection or GeoIp service.', 'woocommerce-currency-switcher') . '</i>';
                                    }
                                    ?>

                                </th>
                                <td class="forminp forminp-select">
                                    <?php
                                    $opts = array(
                                        0 => esc_html__('No', 'woocommerce-currency-switcher'),
                                        1 => esc_html__('Yes', 'woocommerce-currency-switcher')
                                    );
                                    $selected = get_option('woocs_force_pay_bygeoip_rules', 0);
                                    ?>
                                    <select name="woocs_force_pay_bygeoip_rules" id="woocs_force_pay_bygeoip_rules"  class="chosen_select enhanced woocs_settings_dd" tabindex="-1" title="<?php esc_html_e('Checkout by GeoIP rules', 'woocommerce-currency-switcher') ?>">

                                        <?php foreach ($opts as $val => $title): ?>
                                            <option value="<?php echo $val ?>" <?php echo selected($selected, $val) ?>><?php echo $title ?></option>
                                        <?php endforeach; ?>

                                    </select>
                                </td>
                            </tr>
                            <?php if (version_compare($WOOCS->actualized_for, '3.3', '>='))://WOO 33 ?>
                                <tr valign="top" class="<?php if (!$woocs_is_multiple_allowed): ?>woocs_settings_hide<?php endif; ?>" >
                                    <th scope="row" class="titledesc">
                                        <label for="woocs_is_fixed_coupon"><?php esc_html_e('Individual fixed amount for coupon', 'woocommerce-currency-switcher') ?>(*)</label>
                                        <span class="woocommerce-help-tip woocs_settings_tip"  data-tip="<?php esc_html_e("You will be able to set FIXED amount for coupon for each currency. ATTENTION: 'Is multiple allowed' should be enabled!", 'woocommerce-currency-switcher') ?>"></span>
                                    </th>
                                    <td class="forminp forminp-select">
                                        <?php
                                        $opts = array(
                                            0 => esc_html__('No', 'woocommerce-currency-switcher'),
                                            1 => esc_html__('Yes', 'woocommerce-currency-switcher')
                                        );
                                        $woocs_is_fixed_coupon = get_option('woocs_is_fixed_coupon', 0);
                                        ?>
                                        <select name="woocs_is_fixed_coupon" id="woocs_is_fixed_coupon"  class="chosen_select enhanced woocs_settings_dd" tabindex="-1" title="<?php esc_html_e('Enable fixed coupon', 'woocommerce-currency-switcher') ?>">

                                            <?php foreach ($opts as $val => $title): ?>
                                                <option value="<?php echo $val ?>" <?php echo selected($woocs_is_fixed_coupon, $val) ?>><?php echo $title ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                    </td>
                                </tr>

                                <tr valign="top" class="<?php if (!$woocs_is_multiple_allowed): ?>woocs_settings_hide<?php endif; ?>">
                                    <th scope="row" class="titledesc">
                                        <label for="woocs_is_fixed_shipping"><?php esc_html_e('Individual fixed amount for shipping', 'woocommerce-currency-switcher') ?>(*)</label>
                                        <span class="woocommerce-help-tip woocs_settings_tip"  data-tip="<?php esc_html_e("You will be able to set FIXED amount for each currency for free and all another shipping ways. ATTENTION: 'Is multiple allowed' should be enabled!", 'woocommerce-currency-switcher') ?>"></span>
                                    </th>
                                    <td class="forminp forminp-select">
                                        <?php
                                        $optns = array(
                                            0 => esc_html__('No', 'woocommerce-currency-switcher'),
                                            1 => esc_html__('Yes', 'woocommerce-currency-switcher')
                                        );
                                        $woocs_is_fixed_shipping = get_option('woocs_is_fixed_shipping', 0);
                                        ?>
                                        <select name="woocs_is_fixed_shipping" id="woocs_is_fixed_shipping"  class="chosen_select enhanced woocs_settings_dd" tabindex="-1" title="<?php esc_html_e('Enable fixed for Shipping', 'woocommerce-currency-switcher') ?>">

                                            <?php foreach ($optns as $val => $title): ?>
                                                <option value="<?php echo $val ?>" <?php echo selected($woocs_is_fixed_shipping, $val) ?>><?php echo $title ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row" class="titledesc">
                                        <label for="woocs_is_fixed_user_role"><?php esc_html_e('Individual prices based on user role', 'woocommerce-currency-switcher') ?>(*)</label>
                                        <span class="woocommerce-help-tip woocs_settings_user_tip"  data-tip="<?php esc_html_e('Gives ability to set different prices for each user role', 'woocommerce-currency-switcher') ?>"></span>
                                    </th>
                                    <td class="forminp forminp-select">
                                        <?php
                                        $opts = array(
                                            0 => esc_html__('No', 'woocommerce-currency-switcher'),
                                            1 => esc_html__('Yes', 'woocommerce-currency-switcher')
                                        );
                                        $selected = get_option('woocs_is_fixed_user_role', 0);
                                        ?>
                                        <select name="woocs_is_fixed_user_role" id="woocs_is_fixed_user_role"  class="chosen_select enhanced woocs_settings_dd" tabindex="-1" title="<?php esc_html_e('User role price ', 'woocommerce-currency-switcher') ?>">

                                            <?php foreach ($opts as $val => $title): ?>
                                                <option value="<?php echo $val ?>" <?php echo selected($selected, $val) ?>><?php echo $title ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                    </td>
                                </tr>                   
                            <?php endif; //end woo33?>
                            <tr valign="top">
                                <th scope="row" class="titledesc">
                                    <label for="woocs_is_geoip_manipulation"><?php esc_html_e('Individual GeoIP rules for each product', 'woocommerce-currency-switcher') ?>(*)</label>
                                    <span class="woocommerce-help-tip woocs_settings_user_tip" data-tip="<?php esc_html_e("You will be able to set different prices for each product (in BASIC currency) for different countries", 'woocommerce-currency-switcher') ?>"></span>
                                </th>
                                <td class="forminp forminp-select">
                                    <?php
                                    $opts = array(
                                        0 => esc_html__('No', 'woocommerce-currency-switcher'),
                                        1 => esc_html__('Yes', 'woocommerce-currency-switcher')
                                    );
                                    $selected = get_option('woocs_is_geoip_manipulation', 0);
                                    ?>
                                    <select name="woocs_is_geoip_manipulation" id="woocs_is_geoip_manipulation"  class="chosen_select enhanced woocs_settings_dd" tabindex="-1" title="<?php esc_html_e('GeoIp product price manipulation', 'woocommerce-currency-switcher') ?>">

                                        <?php foreach ($opts as $val => $title): ?>
                                            <option value="<?php echo $val ?>" <?php echo selected($selected, $val) ?>><?php echo $title ?></option>
                                        <?php endforeach; ?>

                                    </select>
                                    &nbsp;<a href="https://currency-switcher.com/video-tutorials#video_PZugTH80-Eo" target="_blank" class="button"><?php esc_html_e('Watch video instructions', 'woocommerce-currency-switcher') ?></a>
                                    &nbsp;<a href="https://currency-switcher.com/video-tutorials#video_zh_LVqKADBU" target="_blank" class="button"><?php esc_html_e('a hint', 'woocommerce-currency-switcher') ?></a>
                                </td>
                            </tr>


                            <tr valign="top">
                                <th scope="row" class="titledesc">
                                    <label><?php esc_html_e('Notes*', 'woocommerce-currency-switcher') ?></label>
                                </th>
                                <td class="forminp forminp-select">

                                    <i><?php esc_html_e('Native WooCommerce price filter is blind for all data generated by marked features', 'woocommerce-currency-switcher') ?></i>

                                </td>
                            </tr>


                        </tbody>
                    </table>




                </section>
                <?php if (version_compare($WOOCS->actualized_for, '3.3', '>='))://WOO 33 ?>
                    <section id="tabs-6" class="woocs_settings_section" >

                        <a href="https://currency-switcher.com/documentation/#section_1_3" class="button button-primary woocs_settings_docs"  target="_blank"><?php esc_html_e('Documentation', 'woocommerce-currency-switcher') ?></a>

                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row" class="titledesc">
                                        <label for="woocs_is_auto_switcher"><?php esc_html_e('Enable/Disable', 'woocommerce-currency-switcher') ?></label>
                                        <span class="woocommerce-help-tip" data-tip="<?php esc_html_e('Enable/Disable the side currency switcher on your page', 'woocommerce-currency-switcher') ?>"></span>
                                    </th>
                                    <td class="forminp forminp-select">
                                        <?php
                                        $opts = array(
                                            0 => esc_html__('Disable', 'woocommerce-currency-switcher'),
                                            1 => esc_html__('Enable', 'woocommerce-currency-switcher')
                                        );
                                        $woocs_is_auto_switcher = get_option('woocs_is_auto_switcher', 0);
                                        ?>
                                        <select name="woocs_is_auto_switcher" id="woocs_is_auto_switcher"  class="chosen_select enhanced woocs_settings_dd" tabindex="-1" title="<?php esc_html_e('Show auto switcher', 'woocommerce-currency-switcher') ?>">

                                            <?php foreach ($opts as $val => $title): ?>
                                                <option value="<?php echo $val ?>" <?php echo selected($woocs_is_auto_switcher, $val) ?>><?php echo $title ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                    </td>
                                </tr>

                                <tr valign="top" class="<?php if (!$woocs_is_auto_switcher): ?>woocs_settings_hide<?php endif; ?>">
                                    <th scope="row" class="titledesc">
                                        <label for="woocs_auto_switcher_skin"><?php esc_html_e('Skin', 'woocommerce-currency-switcher') ?></label>
                                        <span class="woocommerce-help-tip woocs_settings_tip"  data-tip="<?php esc_html_e("Style of the switcher on the site front", 'woocommerce-currency-switcher') ?>"></span>
                                    </th>
                                    <td class="forminp forminp-select">
                                        <?php
                                        $opts = array(
                                            'classic_blocks' => esc_html__('Classic blocks', 'woocommerce-currency-switcher'),
                                            'roll_blocks' => esc_html__('Roll blocks', 'woocommerce-currency-switcher'),
                                            // 'round_chain' => esc_html__('Round chain', 'woocommerce-currency-switcher'),
                                            'round_select' => esc_html__('Round select', 'woocommerce-currency-switcher'),
                                        );
                                        $woocs_auto_switcher_skin = get_option('woocs_auto_switcher_skin', 'classic_blocks');
                                        ?>
                                        <select name="woocs_auto_switcher_skin" id="woocs_auto_switcher_skin"  class="chosen_select enhanced woocs_settings_dd" tabindex="-1" title="<?php esc_html_e('Choise skin', 'woocommerce-currency-switcher') ?>">

                                            <?php foreach ($opts as $val => $title): ?>
                                                <option value="<?php echo $val ?>" <?php echo selected($woocs_auto_switcher_skin, $val) ?>><?php echo $title ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="woocs_roll_blocks_width" class="<?php if ($woocs_auto_switcher_skin != 'roll_blocks'): ?>woocs_settings_hide<?php endif; ?>">
                                            <input type="text" name="woocs_auto_switcher_roll_px" id="woocs_auto_switcher_roll_px" placeholder="<?php esc_html_e('enter roll width', 'woocommerce-currency-switcher') ?>"  value="<?php echo get_option('woocs_auto_switcher_roll_px', 90) ?>" />.px<br />
                                        </div>                          
                                    </td>

                                </tr>
                                <tr valign="top" class="<?php if (!$woocs_is_auto_switcher): ?>woocs_settings_hide<?php endif; ?>">
                                    <th scope="row" class="titledesc">
                                        <label for="woocs_auto_switcher_side"><?php esc_html_e('Side', 'woocommerce-currency-switcher') ?></label>
                                        <span class="woocommerce-help-tip woocs_settings_tip"  data-tip="<?php esc_html_e("The side where the switcher is be placed", 'woocommerce-currency-switcher') ?>"></span>
                                    </th>
                                    <td class="forminp forminp-select">
                                        <?php
                                        $opts = array(
                                            'left' => esc_html__('Left', 'woocommerce-currency-switcher'),
                                            'right' => esc_html__('Right', 'woocommerce-currency-switcher'),
                                        );
                                        $woocs_auto_switcher_side = get_option('woocs_auto_switcher_side', 'left');
                                        ?>
                                        <select name="woocs_auto_switcher_side" id="woocs_auto_switcher_side"  class="chosen_select enhanced woocs_settings_dd" tabindex="-1" title="<?php esc_html_e('Choise side', 'woocommerce-currency-switcher') ?>">

                                            <?php foreach ($opts as $val => $title): ?>
                                                <option value="<?php echo $val ?>" <?php echo selected($woocs_auto_switcher_side, $val) ?>><?php echo $title ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr valign="top" class="<?php if (!$woocs_is_auto_switcher): ?>woocs_settings_hide<?php endif; ?>">
                                    <th scope="row" class="titledesc">
                                        <label for="woocs_auto_switcher_top_margin"><?php esc_html_e('Top margin', 'woocommerce-currency-switcher') ?></label>
                                        <span class="woocommerce-help-tip woocs_settings_tip"  data-tip="<?php esc_html_e("Distance from the top of the screen to the switcher html block. You can set in px or in %. Example 1: 100px. Example 2: 10%.", 'woocommerce-currency-switcher') ?>"></span>
                                    </th>
                                    <td class="forminp forminp-select">
                                        <?php
                                        $woocs_auto_switcher_top_margin = get_option('woocs_auto_switcher_top_margin', '100px');
                                        ?>
                                        <input type="text" name="woocs_auto_switcher_top_margin" id="woocs_auto_switcher_top_margin" class="woocs_settings_dd" value="<?php echo $woocs_auto_switcher_top_margin ?>" >
                                    </td>
                                </tr>
                                <?php
                                $color = array(
                                    array(
                                        'name' => esc_html__('Main color', 'woocommerce-currency-switcher'),
                                        'desc' => esc_html__('Main color which coloring the switcher elements', 'woocommerce-currency-switcher'),
                                        'id' => 'woocs_auto_switcher_color',
                                        'type' => 'color',
                                        'std' => '', // WooCommerce < 2.0
                                        'default' => '#222222', // WooCommerce >= 2.0
                                        'css' => 'min-width:500px;',
                                        'desc_tip' => true
                                    ),
                                    array(
                                        'name' => esc_html__('Hover color', 'woocommerce-currency-switcher'),
                                        'desc' => esc_html__('The switcher color when mouse hovering', 'woocommerce-currency-switcher'),
                                        'id' => 'woocs_auto_switcher_hover_color',
                                        'type' => 'color',
                                        'std' => '', // WooCommerce < 2.0
                                        'default' => '#3b5998', // WooCommerce >= 2.0
                                        'css' => 'min-width:500px;',
                                        'desc_tip' => true
                                    ),
                                        // array('type' => 'sectionend', 'id' => 'woocs_color')
                                );

                                woocommerce_admin_fields($color);
                                ?>
                                <tr valign="top" class="<?php if (!$woocs_is_auto_switcher): ?>woocs_settings_hide<?php endif; ?>">
                                    <th scope="row" class="titledesc">
                                        <label for="woocs_auto_switcher_basic_field"><?php esc_html_e('Basic field(s)', 'woocommerce-currency-switcher') ?></label>
                                        <span class="woocommerce-help-tip woocs_settings_tip"  data-tip="<?php esc_html_e("What content to show in the switcher after the site page loading. Variants:  __CODE__ __FLAG___ __SIGN__ __DESCR__", 'woocommerce-currency-switcher') ?>"></span>
                                    </th>
                                    <td class="forminp forminp-select">
                                        <?php
                                        $woocs_auto_switcher_basic_field = get_option('woocs_auto_switcher_basic_field', '__CODE__ __SIGN__');
                                        ?>
                                        <input type="text" name="woocs_auto_switcher_basic_field" id="woocs_auto_switcher_basic_field" class="woocs_settings_dd" value="<?php echo $woocs_auto_switcher_basic_field ?>" >
                                    </td>
                                </tr>
                                <tr valign="top" class="<?php if (!$woocs_is_auto_switcher): ?>woocs_settings_hide<?php endif; ?>">
                                    <th scope="row" class="titledesc">
                                        <label for="woocs_auto_switcher_additional_field"><?php esc_html_e('Hover field(s)', 'woocommerce-currency-switcher') ?></label>
                                        <span class="woocommerce-help-tip woocs_settings_tip"  data-tip="<?php esc_html_e("What content to show in the switcher after mouse hover on any currency there. Variants:  __CODE__ __FLAG___ __SIGN__ __DESCR__", 'woocommerce-currency-switcher') ?>"></span>
                                    </th>
                                    <td class="forminp forminp-select">
                                        <?php
                                        $woocs_auto_switcher_additional_field = get_option('woocs_auto_switcher_additional_field', '__DESCR__');
                                        ?>
                                        <input type="text" name="woocs_auto_switcher_additional_field" id="woocs_auto_switcher_additional_field" class="woocs_settings_dd" value="<?php echo $woocs_auto_switcher_additional_field ?>" >
                                    </td>
                                </tr>
                                <tr valign="top" class="<?php if (!$woocs_is_auto_switcher): ?>woocs_settings_hide<?php endif; ?>">
                                    <th scope="row" class="titledesc">
                                        <label for="woocs_auto_switcher_show_page"><?php esc_html_e('Show on the pages', 'woocommerce-currency-switcher') ?></label>
                                        <span class="woocommerce-help-tip woocs_settings_tip"  data-tip="<?php esc_html_e("Where on the site the switcher should be visible. If any value is presented here switcher will be hidden on all another pages which not presented in this field. You can use pages IDs using comma, example: 28,34,232. Also you can use special words as: product, shop, checkout, front_page, woocommerce", 'woocommerce-currency-switcher') ?>"></span>
                                    </th>
                                    <td class="forminp forminp-select">
                                        <?php
                                        $woocs_auto_switcher_show_page = get_option('woocs_auto_switcher_show_page', '');
                                        ?>
                                        <input type="text" name="woocs_auto_switcher_show_page" id="woocs_auto_switcher_show_page" class="woocs_settings_dd" value="<?php echo $woocs_auto_switcher_show_page ?>" >
                                    </td>
                                </tr>
                                <tr valign="top" class="<?php if (!$woocs_is_auto_switcher): ?>woocs_settings_hide<?php endif; ?>">
                                    <th scope="row" class="titledesc">
                                        <label for="woocs_auto_switcher_hide_page"><?php esc_html_e('Hide on the pages', 'woocommerce-currency-switcher') ?></label>
                                        <span class="woocommerce-help-tip woocs_settings_tip"  data-tip="<?php esc_html_e("Where on the site the switcher should be hidden. If any value is presented here switcher will be hidden on that pages and visible on all another ones. You can use pages IDs using comma, example: 28,34,232. Also you can use special words as: product, shop, checkout, front_page, woocommerce", 'woocommerce-currency-switcher') ?>"></span>
                                    </th>
                                    <td class="forminp forminp-select">
                                        <?php
                                        $woocs_auto_switcher_hide_page = get_option('woocs_auto_switcher_hide_page', '');
                                        ?>
                                        <input type="text" name="woocs_auto_switcher_hide_page" id="woocs_auto_switcher_hide_page" class="woocs_settings_dd" value="<?php echo $woocs_auto_switcher_hide_page ?>" >
                                    </td>
                                </tr>
                                <tr valign="top" class="<?php if (!$woocs_is_auto_switcher): ?>woocs_settings_hide<?php endif; ?>">
                                    <th scope="row" class="titledesc">
                                        <label for="woocs_auto_switcher_mobile_show"><?php esc_html_e('Behavior for devices', 'woocommerce-currency-switcher') ?></label>
                                        <span class="woocommerce-help-tip woocs_settings_tip" data-tip="<?php esc_html_e("Show/Hide on mobile device (highest priority)", 'woocommerce-currency-switcher') ?>"></span>
                                    </th>
                                    <td class="forminp forminp-select">
                                        <?php
                                        $mobile = array(
                                            0 => esc_html__('Show on all devices', 'woocommerce-currency-switcher'),
                                            '1' => esc_html__('Show on mobile devices only', 'woocommerce-currency-switcher'),
                                            '2' => esc_html__('Hide on mobile devices', 'woocommerce-currency-switcher'),
                                        );
                                        $woocs_auto_switcher_mobile_show = get_option('woocs_auto_switcher_mobile_show', 'left');
                                        ?>
                                        <select name="woocs_auto_switcher_mobile_show" id="woocs_auto_switcher_mobile_show" class="chosen_select enhanced woocs_settings_dd" tabindex="-1" title="<?php esc_html_e('Choise behavior', 'woocommerce-currency-switcher') ?>">

                                            <?php foreach ($mobile as $val => $title): ?>
                                                <option value="<?php echo $val ?>" <?php echo selected($woocs_auto_switcher_mobile_show, $val) ?>><?php echo $title ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                    <?php if ($woocs_is_payments_rule_enable): ?>  
                        <section id="tabs-7" class="woocs_settings_section" >

                            <table class="form-table">
                                <tbody>
                                    <tr valign="top">
                                        <th scope="row" class="titledesc">
                                            <label for="woocs_payment_control"><?php esc_html_e('Payments behavior', 'woocommerce-currency-switcher') ?></label>
                                            <span class="woocommerce-help-tip" data-tip="<?php esc_html_e('Should be payments system be hidden for selected currencies or vice versa shown!', 'woocommerce-currency-switcher') ?>"></span>
                                        </th>
                                        <td class="forminp forminp-select">
                                            <?php
                                            $opts = array(
                                                0 => esc_html__('Is hidden', 'woocommerce-currency-switcher'),
                                                1 => esc_html__('Is shown', 'woocommerce-currency-switcher')
                                            );
                                            $woocs_payment_control = get_option('woocs_payment_control', 0);
                                            ?>
                                            <select name="woocs_payment_control" id="woocs_payment_control" class="chosen_select enhanced woocs_settings_dd" tabindex="-1" title="<?php esc_html_e('Behavior', 'woocommerce-currency-switcher') ?>">

                                                <?php foreach ($opts as $val => $title): ?>
                                                    <option value="<?php echo $val ?>" <?php echo selected($woocs_payment_control, $val) ?>><?php echo $title ?></option>
                                                <?php endforeach; ?>

                                            </select>
                                        </td>
                                    </tr>

                                    <?php
                                    $payments = WC()->payment_gateways->get_available_payment_gateways();
                                    $woocs_payments_rules = get_option('woocs_payments_rules', array());

                                    foreach ($payments as $key => $payment) {
                                        if ($payment->enabled == "yes"):
                                            ?>
                                            <tr valign="top">                                
                                                <th scope="row" class="titledesc">
                                                    <label for="woocs_payment_rule"><?php echo $payment->title ?></label>
                                                </th>
                                                <td class="forminp forminp-select">                                   
                                                    <select name="woocs_payments_rules[<?php echo $key ?>][]" multiple=""  class="chosen_select woocs_settings_dd"  title="<?php esc_html_e('Choise currencies', 'woocommerce-currency-switcher') ?>">
                                                        <?php
                                                        $payment_rules = array();
                                                        if (isset($woocs_payments_rules[$key])) {
                                                            $payment_rules = $woocs_payments_rules[$key];
                                                        }
                                                        if (!empty($currencies) AND is_array($currencies)) {
                                                            foreach ($currencies as $key_curr => $currency) {
                                                                ?>
                                                                <option value="<?php echo $key_curr ?>" <?php echo(in_array($key_curr, $payment_rules) ? 'selected=""' : '') ?>><?php echo $key_curr ?></option>    
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <?php
                                        endif;
                                    }
                                    ?>                       
                                </tbody>
                            </table>
                        </section>  
                    <?php endif; ?>
                <?php endif; //end woo33 ?>
                <?php if ($this->is_use_geo_rules()): ?>
                    <section id="tabs-4">


                        <?php if (version_compare(WOOCOMMERCE_VERSION, '2.3', '<')): ?>

                            <b class="woocs_hint"><?php esc_html_e("GeoIP works from v.2.3 of the WooCommerce plugin and no with minor versions of WooCommerce!!", 'woocommerce-currency-switcher'); ?></b><br />

                        <?php endif; ?>

                        <?php if (empty($pd)): ?>

                            <b class="woocs_hint"><?php esc_html_e("WooCommerce GeoIP functionality doesn't work on your site. Maybe <a href='https://wordpress.org/support/topic/geolocation-not-working-1/?replies=10' target='_blank'>this</a> will help you.", 'woocommerce-currency-switcher'); ?></b><br />

                        <?php endif; ?>
                        <ul>
                            <?php
                            if (!empty($currencies) AND is_array($currencies)) {
                                foreach ($currencies as $key => $currency) {
                                    $rules = array();
                                    if (isset($geo_rules[$key])) {
                                        $rules = $geo_rules[$key];
                                    }
                                    ?>
                                    <li>
                                        <table class="woocs_settings_geo_table" >
                                            <tr>
                                                <td class="woocs_settings_geo_table_title" >
                                                    <div class="<?php if ($currency['is_etalon']): ?>woocs_hint<?php endif; ?>"><strong><?php echo $key ?></strong>:</div>
                                                </td>
                                                <td class="woocs_settings_geo_table_td">
                                                    <select name="woocs_geo_rules[<?php echo $currency['name'] ?>][]" multiple="" size="1"  class="chosen_select">
                                                        <option value="0"></option>
                                                        <?php foreach ($countries as $key => $value): ?>
                                                            <option <?php echo(in_array($key, $rules) ? 'selected=""' : '') ?> value="<?php echo $key ?>"><?php echo $value ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </section>
                <?php else: ?>
                    <input type="hidden" name="woocs_geo_rules" value="" />
                <?php endif; ?>



                <section id="tabs-5">

                    <ol class="woocs-info">
                        <li><a href="https://currency-switcher.com/get-flags-free/" target="_blank"><?php esc_html_e("Free flags images", 'woocommerce-currency-switcher') ?></a></li>

                        <li><a href="https://currency-switcher.com/category/faq/" target="_blank"><?php esc_html_e("FAQ", 'woocommerce-currency-switcher') ?></a></li>

                        <li><a href="https://currency-switcher.com/codex/" target="_blank"><?php esc_html_e("Codex", 'woocommerce-currency-switcher') ?></a></li>

                        <li><a href="https://currency-switcher.com/video-tutorials/" target="_blank"><?php esc_html_e("Video tutorials", 'woocommerce-currency-switcher') ?></a></li>

                        <li><a href="http://en.wikipedia.org/wiki/ISO_4217#Active_codes" target="_blank"><?php esc_html_e("Read wiki about Currency Active codes", 'woocommerce-currency-switcher') ?></a></li>
                    </ol>

                    <hr />

                    <?php
                    $rate_url = 'https://codecanyon.net/downloads';
                    if ($WOOCS->notes_for_free) {
                        $rate_url = 'https://wordpress.org/support/plugin/woocommerce-currency-switcher/reviews/#new-post';
                    }
                    ?>

                    <b>We work hard to make this plugin more effective tool for your e-shops, and ready to <a href="<?= $rate_url ?>" target="_blank" style="color: orange;">hear your review, suggestions and opinions</a>, please share it with us!</b><br />

                    <hr />
                    <ol class="woocs-info">

                        <li><a href="https://currency-switcher.com/i-cant-add-flags-what-to-do/" target="_blank"><?php esc_html_e("I cant add flags! What to do?", 'woocommerce-currency-switcher') ?></a></li>
                        <li><a href="https://currency-switcher.com/using-geolocation-causes-problems-doesnt-seem-to-work-for-me/" target="_blank"><?php esc_html_e("Using Geolocation causes problems, doesn’t seem to work for me", 'woocommerce-currency-switcher') ?></a></li>
                        <li><a href="https://currency-switcher.com/wp-content/uploads/2017/09/woocs-options.png" target="_blank"><?php esc_html_e("The plugin options example screen", 'woocommerce-currency-switcher') ?></a></li>
                    </ol>

                    <hr />

                    <h3><?php esc_html_e("Quick introduction", 'woocommerce-currency-switcher') ?></h3>

                    <iframe width="560" height="315" src="https://www.youtube.com/embed/wUoM9EHjnYs" frameborder="0" allowfullscreen></iframe>

                    <hr />

                    <h3><?php esc_html_e("More power for your shop", 'woocommerce-currency-switcher') ?></h3>


                    <a href="http://codecanyon.net/item/woof-woocommerce-products-filter/11498469?ref=realmag777" target="_blank"><img src="<?php echo WOOCS_LINK ?>img/woof_banner.png" /></a>&nbsp;
                    <a href="https://codecanyon.net/item/woobe-woocommerce-bulk-editor-professional/21779835?ref=realmag777" target="_blank"><img width="300" src="<?php echo WOOCS_LINK ?>img/woobe_banner.png" /></a>



                    <?php if (!$WOOCS->notes_for_free): ?>
                        <hr />
                        <div id="plugin_warning" >
                            <div class="plugin_warning_head"><strong class="woocs_settings_red" >ATTENTION MESSAGE FROM THE PLUGIN AUTHOR TO ALL USERS WHO USES PIRATE VERSION OF THE PLUGIN! IF YOU BOUGHT IT - DO NOT READ AND IGNORE IT!</strong>!<br></div>
                            <br />
                            GET YOUR COPY OF THE PLUGIN <em> <span class="woocs_settings_underline"><span class="woocs_settings_ff"><strong>ONLY</strong></span></span></em> FROM <a href="http://codecanyon.net/item/woocommerce-currency-switcher/8085217?ref=realmag777" target="_blank"><span class="woocs_settings_green"><strong>CODECANYON.NET</strong></span></a> OR <span class="woocs_settings_green"><strong><a href="https://wordpress.org/plugins/woocommerce-currency-switcher/" target="_blank">WORDPRESS.ORG</a></strong></span> IF YOU DO NOT WANT TO BE AN AFFILIATE OF ANY VIRUS SITE.<br>
                            <br>
                            <strong>DID YOU CATCH A VIRUS DOWNLOADING THE PLUGIN FROM ANOTHER (PIRATE) SITES<span class="woocs_settings_ff">?</span></strong> THIS IS YOUR TROUBLES AND <em>DO NOT WRITE TO SUPPORT THAT GOOGLE DOWN YOUR SITE TO ZERO BECAUSE OF &nbsp;ANY VIRUS</em>!!<br>
                            <br>
                            <strong><span  class="woocs_settings_ff" >REMEMBER</span></strong> - if somebody suggesting YOU premium version of the plugin for free - think twenty times before installing it ON YOUR SITE, as it can be trap for it! <strong>DOWNLOAD THE PLUGIN ONLY FROM OFFICIAL SITES TO AVOID THE COLLAPSE OF YOUR BUSINESS</strong>.<br>
                            <br>
                            <strong class="woocs_settings_ff">Miser pays twice</strong>!<br>
                            <br>
                            P.S. Reason of this warning text - emails from the users! Be care!!
                        </div>

                    <?php endif; ?>


                </section>



            </div>
        </div>



        <div class="woocs_settings_powered">
            <a href="https://pluginus.net/" target="_blank" >Powered by PluginUs.NET</a>
        </div>


    </div>
    <br />


    <b class="woocs_hint" ><?php esc_html_e('Hint', 'woocommerce-currency-switcher'); ?>:</b>&nbsp;<?php esc_html_e('To update all currencies rates by one click - press radio button of the default currency and then press "Save changes" button!', 'woocommerce-currency-switcher'); ?><br />
    <b class="woocs_hint" ><?php esc_html_e('Hint', 'woocommerce-currency-switcher'); ?>:</b>&nbsp;<?php esc_html_e('If you not found money sign you need you can always add it in the tab Options -> Custom money signs', 'woocommerce-currency-switcher'); ?><br />
    <b class="woocs_hint" ><?php esc_html_e('Hint', 'woocommerce-currency-switcher'); ?>:</b>&nbsp;<?php esc_html_e('If you want let your customers pay in their selected currency in tab Advanced set the option Is multiple allowed to Yes.', 'woocommerce-currency-switcher'); ?><br />
    <b class="woocs_hint" ><?php esc_html_e('Hint', 'woocommerce-currency-switcher'); ?>:</b>&nbsp;<?php esc_html_e('To get free API key for:', 'woocommerce-currency-switcher'); ?>
    &nbsp;<a href="https://free.currencyconverterapi.com/free-api-key"  target="_blank"><?php esc_html_e('The Free Currency Converter', 'woocommerce-currency-switcher'); ?></a>
    <?php esc_html_e('OR', 'woocommerce-currency-switcher'); ?>
    &nbsp;<a href="https://fixer.io/signup/free" target="_blank"><?php esc_html_e('Fixer', 'woocommerce-currency-switcher'); ?></a><br />


    <?php if ($WOOCS->notes_for_free): ?>
        <hr />

        <div ><i>In the free version of the plugin <b class="woocs_settings_red">you can operate with 2 ANY currencies only</b>! If you want to use more currencies <a href="https://codecanyon.net/item/woocommerce-currency-switcher/8085217?ref=realmag777" target="_blank">you can make upgrade to the premium version</a> of the plugin</i></div><br />

        <table class="woocs_settings_promotion" >
            <tr>
                <td >
                    <h3 class="woocs_settings_red"><?php esc_html_e("UPGRADE to Full version", 'woocommerce-currency-switcher') ?>:</h3>
                    <a href="http://codecanyon.net/item/woocommerce-currency-switcher/8085217?ref=realmag777" target="_blank"><img src="<?php echo WOOCS_LINK ?>img/woocs_banner.png" width="300" alt="<?php esc_html_e("full version of the plugin", 'woocommerce-currency-switcher'); ?>" /></a>
                </td>

                <td >
                    <h3><?php esc_html_e("WOOF - WooCommerce Products Filter", 'woocommerce-currency-switcher') ?>:</h3>
                    <a href="http://codecanyon.net/item/woof-woocommerce-products-filter/11498469?ref=realmag777" target="_blank"><img src="<?php echo WOOCS_LINK ?>img/woof_banner.png" alt="<?php esc_html_e("WOOF - WooCommerce Products Filter", 'woocommerce-currency-switcher'); ?>" /></a>
                </td>

                <td >
                    <h3><?php esc_html_e("WOOBE - WooCommerce Bulk Editor Professional", 'woocommerce-currency-switcher') ?>:</h3>
                    <a href="https://bulk-editor.com/" target="_blank"><img src="<?php echo WOOCS_LINK ?>img/woobe_banner.png" width="300" alt="<?php esc_html_e("WOOBE - WooCommerce Bulk Editor Professional", 'woocommerce-currency-switcher'); ?>" /></a>
                </td>

            </tr>
        </table>
    <?php endif; ?>


    <div class="info_popup woocs_settings_hide" ></div>

</div>

<?php

function woocs_print_currency($_this, $currency) {
    global $WOOCS;
    ?>
    <li>

        <label class="container">
            <input class="help_tip woocs_is_etalon" data-tip="<?php esc_html_e("Set etalon main currency. This should be the currency in which the price of goods exhibited!", 'woocommerce-currency-switcher') ?>" type="radio" <?php checked(1, $currency['is_etalon']) ?> />
            <input type="hidden" name="woocs_is_etalon[]" value="<?php echo $currency['is_etalon'] ?>" />
            <span class="checkmark"></span>
        </label>

        <input type="text" value="<?php echo $currency['name'] ?>" name="woocs_name[]" class="woocs-text woocs-currency" placeholder="<?php esc_html_e("Exmpl.: USD,EUR", 'woocommerce-currency-switcher') ?>" />
        <select class="woocs-drop-down woocs-symbol" name="woocs_symbol[]">
            <?php foreach ($_this->currency_symbols as $symbol) : ?>
                <option value="<?php echo md5($symbol) ?>" <?php selected(md5($currency['symbol']), md5($symbol)) ?>><?php echo $symbol; ?></option>
            <?php endforeach; ?>
        </select>
        <select class="woocs-drop-down woocs-position" name="woocs_position[]" style="width: 120px;">
            <option value="0"><?php esc_html_e("Select symbol position", 'woocommerce-currency-switcher'); ?></option>
            <?php
            foreach ($_this->currency_positions as $position) :

                switch ($position) {
                    case 'right':
                        $position_desc_sign = esc_html__('P$ - right', 'woocommerce-currency-switcher');
                        break;

                    case 'right_space':
                        $position_desc_sign = esc_html__('P $ - right space', 'woocommerce-currency-switcher');
                        break;

                    case 'left_space':
                        $position_desc_sign = esc_html__('$ P - left space', 'woocommerce-currency-switcher');
                        break;

                    default:
                        $position_desc_sign = esc_html__('$P - left', 'woocommerce-currency-switcher');
                        break;
                }
                ?>
                <option value="<?php echo $position ?>" <?php selected($currency['position'], $position) ?>><?php echo $position_desc_sign ?></option>
            <?php endforeach; ?>
        </select>
        <select name="woocs_decimals[]" class="woocs-drop-down woocs-decimals">
            <?php
            $woocs_decimals = array(
                -1 => esc_html__("Decimals", 'woocommerce-currency-switcher'),
                0 => 0,
                1 => 1,
                2 => 2,
                3 => 3,
                4 => 4,
                5 => 5,
                6 => 6,
                7 => 7,
                8 => 8
            );
            if (!isset($currency['decimals'])) {
                $currency['decimals'] = 2;
            }
            ?>
            <?php foreach ($woocs_decimals as $v => $n): ?>
                <option <?php if ($currency['decimals'] == $v): ?>selected=""<?php endif; ?> value="<?php echo $v ?>"><?php echo $n ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text"  value="<?php echo $currency['rate'] ?>" name="woocs_rate[]" class="woocs-text woocs-rate" placeholder="<?php esc_html_e("exchange rate", 'woocommerce-currency-switcher') ?>" />
        <button class="button woocs_finance_btn woocs_finance_yahoo help_tip" data-tip="<?php esc_html_e("Press this button if you want get currency rate from the selected aggregator above!", 'woocommerce-currency-switcher') ?>"><span class="woocs-btn-update-rate dashicons-before dashicons-update" ></span></button>
        <select name="woocs_hide_cents[]" class="woocs-drop-down" <?php if (in_array($currency['name'], $WOOCS->no_cents)): ?>disabled=""<?php endif; ?>>
            <?php
            $woocs_hide_cents = array(
                0 => esc_html__("Show cents", 'woocommerce-currency-switcher'),
                1 => esc_html__("Hide cents", 'woocommerce-currency-switcher')
            );
            if (in_array($currency['name'], $WOOCS->no_cents)) {
                $currency['hide_cents'] = 1;
            }
            $hide_cents = 0;
            if (isset($currency['hide_cents'])) {
                $hide_cents = $currency['hide_cents'];
            }
            ?>
            <?php foreach ($woocs_hide_cents as $v => $n): ?>
                <option <?php if ($hide_cents == $v): ?>selected=""<?php endif; ?> value="<?php echo $v ?>"><?php echo $n ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" value="<?php echo $currency['description'] ?>" name="woocs_description[]"  class="woocs-text woocs_curr_description" placeholder="<?php esc_html_e("description", 'woocommerce-currency-switcher') ?>" />
        <?php
        $flag = WOOCS_LINK . 'img/no_flag.png';
        if (isset($currency['flag']) AND ! empty($currency['flag'])) {
            $flag = $currency['flag'];
        }
        ?>
        <input type="hidden" value="<?php echo $flag ?>" class="woocs_flag_input" name="woocs_flag[]" />
        <a href="#" class="woocs_flag help_tip woocs_settings_flag_tip" data-tip="<?php esc_html_e("Click to select the flag", 'woocommerce-currency-switcher'); ?>" ><img src="<?php echo $flag ?>"  alt="<?php esc_html_e("Flag", 'woocommerce-currency-switcher'); ?>" /></a>
        &nbsp;<a href="#" class="help_tip woocs_settings_move" data-tip="<?php esc_html_e("drag and drope", 'woocommerce-currency-switcher'); ?>"><img  src="<?php echo WOOCS_LINK ?>img/move.png" alt="<?php esc_html_e("move", 'woocommerce-currency-switcher'); ?>" /></a>
    </li>
    <?php
}
