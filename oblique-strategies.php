<?php 

/*
Plugin Name: Oblique Strategies
Plugin URI: http://matthewruten.com
Description: Adds Oblique Strategies to your blog.
Version: 1.0
Author: Matthew Ruten
Author URI: http://matthewruten.com
*/

// Return random oblique strateg(y|ies)
// A quantity of 1 will return a single strategy, quantity > 1 will return an array
function random_oblique_strategies($quantity = 1) {
	// Store our data in PHP since there's not too much of it.
	// Data from http://www.rtqe.net/ObliqueStrategies/
	// Used Version 4 -- could expand to include more 
	//    versions if needed, but keep it simple for now!
	$oblique_strategies = array("A line has two sides", "Abandon desire", "Abandon normal instructions", "Accept advice", "Adding on", "Always the first steps", "Ask people to work against their better judgement", "Ask your body", "Be dirty", "Be extravagant", "Be less critical", "Breathe more deeply", "Bridges -build -burn", "Change ambiguities to specifics", "Change nothing and continue consistently", "Change specifics to ambiguities", "Consider transitions", "Courage!", "Cut a vital connection", "Decorate", "Destroy nothing; Destroy the most important thing", "Discard an axiom", "Disciplined self-indulgence", "Discover your formulas and abandon them", "Display your talent", "Distort time", "Do nothing for as long as possible", "Do something boring", "Do something sudden", "Do the last thing first", "Do the words need changing?", "Don't avoid what is easy", "Don't break the silence", "Don't stress one thing more than another", "Emphasize differences", "Emphasize the flaws", "Faced with a choice", "Find a safe part and use it as an anchor", "Give the game away", "Give way to your worst impulse", "Go outside. Shut the door.", "Go outside. Shut the door.", "Go to an extreme", "How would someone else do it?", "How would you have done it?", "In total darkness", "Is it finished?", "Is something missing?", "Is the style right?", "It is simply a matter or work", "Just carry on", "Listen to the quiet voice", "Look at the order in which you do things", "Magnify the most difficult details", "Make it more sensual", "Make what's perfect more human", "Move towards the unimportant", "Not building a wall; making a brick", "Once the search has begun", "Only a part", "Only one element of each kind", "Openly resist change", "Pae White's non-blank graphic metacard", "Question the heroic", "Remember quiet evenings", "Remove a restriction", "Repetition is a form of change", "Retrace your steps", "Reverse", "Simple Subtraction", "Slow preparation", "State the problem as clearly as possible", "Take a break", "Take away the important parts", "The inconsistency principle", "The most easily forgotten thing is the most important", "Think - inside the work -outside the work", "Tidy up", "Try faking it (from Stewart Brand)", "Turn it upside down", "Use 'unqualified' people", "Use an old idea", "Use cliches", "Use filters", "Use something nearby as a model", "Use your own ideas", "Voice your suspicions", "Water", "What context would look right?", "What is the simplest solution?", "What mistakes did you make last time?", "What to increase? What to reduce? What to maintain?", "What were you really thinking about just now?", "What would your closest friend do?", "What wouldn't you do?", "When is it for?", "Where is the edge?", "Which parts can be grouped?", "Work at a different speed", "Would anyone want it?", "Your mistake was a hidden intention");

	// An integer greater or equal to 1 please!
	if (!($quantity > 0)) $quantity = 1; 
	
	// Return strateg(y|ies)
	return $oblique_strategies[array_rand($oblique_strategies, $quantity)];
}


$options = get_option("oblique_options");




/*************************************************
 * Admin Header Display
 *************************************************/
function oblique_admin() {
	echo '<div id="oblique-stragegy"><a href="" target="_blank">Oblique Strategy</a>' . random_oblique_strategies() . '</div>';
}

function oblique_admin_css() {

	echo '<style type="text/css">
	
		#oblique-stragegy {position: relative; margin: 0 0 0 50px; padding: 13px 0; font-size: 20px; float:left;
			text-shadow: 1px 1px 1px #ffffff; min-width: 100px; }

		#oblique-stragegy a {position:absolute; bottom:-2px; right:-10px; font-size:8px; color:white;
			text-shadow: 1px 1px 1px #444444; }
		
	</style>';
}

// Check for negative of 'No' so if the option doesn't exist it will default to Yes
if ($options['admin_showinheader'] != 'No') {
	// Adds to admin html header
	add_action('in_admin_header', 'oblique_admin');

	// Adds to admin <head>
	add_action("admin_head", "oblique_admin_css");
}





/*************************************************
 * Admin Options Panel
 * 
 * Using new Settings API (as of WordPress 2.7)
 * See: http://codex.wordpress.org/Settings_API
 *************************************************/

function oblique_admin_menu() {
	add_options_page("Oblique Strategies Options", "Oblique Strategies", "manage_options", "oblique-strategies", "oblique_plugin_options");
	//add_menu_page("Oblique Strategies Options", "Oblique Strategies", "administrator", __FILE__, "oblique_plugin_options");
}

function oblique_plugin_options() {
	if (!current_user_can("manage_options")) {
		wp_die(__("You do not have sufficient permissions to access this page"));
	}
	
	?>
	<div class="wrap">
		<h2>My Plugin Options</h2>
		<p>Hey! Welcome....</p>
		<form method="post" action="options.php">
			<?php settings_fields("oblique_options_group"); ?>
			<?php do_settings_sections("oblique_strategies"); ?>
			
			<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
		</form>
	</div>
	<?php
}

add_action("admin_menu", "oblique_admin_menu");



function oblique_admin_init() {
	register_setting(
			"oblique_options_group", // option group
			"oblique_options", // option name -- this is the name stored in the DB
			"oblique_options_validate" // sanitization callback
			);
	add_settings_section(
			"oblique_main", // section id (for use in id attribute in tags)
			"Main OB Settings", // section title (displayed)
			"oblique_main_text", // callback for section text (i.e. description)
			"oblique_strategies" // page to show settings on (referenced in do_settings_sections())
			);
	add_settings_field(
			"oblique_admin_showinheader", // field id for use in 'id' attribute in tags
			"Show in admin header?", // option title (displayed)
			"oblique_setting_admin_showinheader", // callback for option content (i.e. form field)
			"oblique_strategies", // page to show option on
			"oblique_main" // section id to display in
			);
}

function oblique_main_text() {
	echo "<p>section description</p>";
}

function oblique_setting_admin_showinheader() {
	$options = get_option("oblique_options");
	
	?>
	<select name="oblique_options[admin_showinheader]" id="oblique_admin_showinheader">
		<option value="Yes" <?php echo ($options['admin_showinheader'] == "Yes") ? 'selected="selected"' : ''; ?>>Yes</option>
		<option value="No" <?php echo ($options['admin_showinheader'] == "No") ? 'selected="selected"' : ''; ?>>No</option>
	</select>
	<?php
	
	//echo '<input id="oblique_admin_showinheader" name="oblique_options[admin_showinheader]" size="40" type="text" value="' . $options['admin_showinheader'] . '" />';
}

// Sanitize/validate input. Input is an array, returns validated array
function oblique_options_validate($input) {
	/*
	
	$newinput['text_anoption'] = trim($input['text_anoption']);
	if (!preg_match('/^[a-z0-9]{1,32}$/i', $newinput['text_anoption'])) {
		$newinput['text_anoption'] = '';
	}
	return $newinput;
	
	*/
	// Gets all options from database
	$options = get_option('oblique_options');
	
	/* Now we just replace the ones we want to update, and the rest will stay the same */
	
	// text_anoption
	/*$options['admin_showinheader'] = trim($input['admin_showinheader']);
	if(!preg_match('/^[a-z0-9]{0,32}$/i', $options['admin_showinheader'])) {
		$options['admin_showinheader'] = '';
	}*/
	
	
	$options['admin_showinheader'] = ($input['admin_showinheader'] == "No") ? "No" : "Yes";
	
	
	return $options;
	
	
}

add_action("admin_init", "oblique_admin_init");




















