<?php
/*
  Plugin Name: Our Test Plugin
  Description: Amazing plugin.
  Version: 1.0
  Author: Erik
  Author URI: www.google.com
  Text Domain: wcpdomain
  Domain Path: /languages
*/

// Put all in a class so you don't need unique name
class WordCountAndTimePlugin {
  function __construct() {
    add_action('admin_menu', array($this, 'adminPage'));
    add_action('admin_init', array($this, 'settings'));
    add_filter('the_content', array($this, 'ifWrap'));
    add_action('init', array($this, 'languages'));
 }

 function languages() {
  load_plugin_textdomain('wcpdomain', false, dirname(plugin_basename(__FILE__)) . '/languages');
  }

 function ifWrap($content) {
  if (is_main_query() AND is_single() AND
  (
    get_option('wcp_wordcount', '1') OR
    get_option('wcp_charactercount', '1') OR
    get_option('wcp_readtime', '1')
  )) {
    return $this->createHTML($content);
  }
  return $content;
  }

  function createHTML($content) {
    $html = '<h3>' . esc_html(get_option('wcp_headline', 'Post Statistics')) . '</h3><p>';

    // get word count once because both wordcount and read time will need it.
    if (get_option('wcp_wordcount', '1') OR get_option('wcp_readtime', '1')) {
      $wordCount = str_word_count(strip_tags($content));
    }

    if (get_option('wcp_wordcount', '1')) {
      $html .= esc_html__('This post has', 'wcpdomain') . ' ' . $wordCount . ' ' . __('words', 'wcpdomain') . '.<br>';
    }

    if (get_option('wcp_charactercount', '1')) {
      $html .= 'This post has ' . strlen(strip_tags($content)) . ' characters.<br>';
    }

    if (get_option('wcp_readtime', '1')) {
      $html .= 'This post will take about ' . round($wordCount/225) . ' minute(s) to read.<br>';
    }

    $html .= '</p>';

    if (get_option('wcp_location', '0') == '0') {
      return $html . $content;
    }
    return $content . $html;
  }

 function settings() {
  // 1. name of the section, 2. title of the section, 3. allows you to have content on the top of the section, 4. the page slug (URL) 
  add_settings_section('wcp_first_section', null, null,'word-count-settings-page');

  // 1. name of the option or settings we want to tie it to, 2. HTML label text, 3. is a function that is responsible to actually output the HTML, 4. is the page slug (URL) for this settings page, 5. the section you want to add this field to
  // locationHTML
  add_settings_field('wcp_location', 'Display Location', array($this, 'locationHTML'), 'word-count-settings-page', 'wcp_first_section');
  // 1. name of the group this setting belongs to, 2. actual name of this specific plugin, 3. array with several different options
  register_setting('wordcountplugin', 'wcp_location', array('sanitize_callback' => array($this, 'sanitizeLocation'), 'default' => '0'));

  // headlineHTML
  add_settings_field('wcp_headline', 'Headline Text', array($this, 'headlineHTML'), 'word-count-settings-page', 'wcp_first_section');
  register_setting('wordcountplugin', 'wcp_headline', array('sanitize_callback' => 'sanitize_text_field', 'default' => 'Post Statistics'));

  // checkboxHTML
  // wordcountHTML
  add_settings_field('wcp_wordcount', 'Word Count', array($this, 'checkboxHTML'), 'word-count-settings-page', 'wcp_first_section', array('theName' => 'wcp_wordcount'));
  register_setting('wordcountplugin', 'wcp_wordcount', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));

  // charactercountHTML
  add_settings_field('wcp_charactercount', 'Character Count', array($this, 'checkboxHTML'), 'word-count-settings-page', 'wcp_first_section', array('theName' => 'wcp_charactercount'));
  register_setting('wordcountplugin', 'wcp_charactercount', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));

  // readtimeHTML
  add_settings_field('wcp_readtime', 'Read Time', array($this, 'checkboxHTML'), 'word-count-settings-page', 'wcp_first_section', array('theName' => 'wcp_readtime'));
  register_setting('wordcountplugin', 'wcp_readtime', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));
 }

 function sanitizeLocation($input) {
  if ($input != '0' AND $input != '1') {
    add_settings_error('wcp_location', 'wcp_location_error', 'Display location must be either beginning or end.');
    return get_option('wcp_location');
  }
  return $input;
  }

 /*
  function wordcountHTML() { ?>
    <input type="checkbox" name="wcp_wordcount" value="1" <?php checked(get_option('wcp_wordcount'), '1') ?>>
  <?php }

  function charactercountHTML() { ?>
    <input type="checkbox" name="wcp_charactercount" value="1" <?php checked(get_option('wcp_charactercount'), '1') ?>>
  <?php }

  function readtimeHTML() { ?>
    <input type="checkbox" name="wcp_readtime" value="1" <?php checked(get_option('wcp_readtime'), '1') ?>>
  <?php }
  */

 // reusable checkbox function
 function checkboxHTML($args) { ?>
  <input type="checkbox" name="<?php echo $args['theName'] ?>" value="1" <?php checked(get_option($args['theName']), '1') ?>>
  <?php }

 function headlineHTML() { ?>
  <input type="text" name="wcp_headline" value="<?php echo esc_attr(get_option('wcp_headline')) ?>">
  <?php }

 function locationHTML() { ?>
  <select name="wcp_location">
    <option value="0" <?php selected(get_option('wcp_location'), '0') ?>>Beginning of post</option>
    <option value="1" <?php selected(get_option('wcp_location'), '1') ?>>End of post</option>
  </select>
 <?php }

  function adminPage() {
  // 1. is the title of the page we want to create, 2. is the text or title of the page that will be used in the settings menu, 3. has to do with permisson and capabilties, 4. is the slug or short name for this page (end of URL), 5. is the function that we give it
    add_options_page('Word Count Settings', __('Word Count', 'wcpdomain'), 'manage_options', 'word-count-settings-page', array($this, 'ourHTML'));
}

  function ourHTML() { ?>
    <div class="wrap">
      <h1>Word Count Settings</h1>
      <form action="options.php" method="POST">
        <?php 
          settings_fields('wordcountplugin');
          do_settings_sections('word-count-settings-page');
          submit_button();
        ?>
      </form>
    </div>
<?php }
}

$wordCountAndTimePlugin = new WordCountAndTimePlugin();



