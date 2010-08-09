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
	$oblique_strategies = array("A line has two sides", "Abandon desire", "Abandon normal instructions", "Accept advice", "Adding on", "Always the first steps", "Ask people to work against their better judgement", "Ask your body", "Be dirty", "Be extravagant", "Be less critical", "Breathe more deeply", "Bridges -build -burn", "Change ambiguities to specifics", "Change nothing and continue consistently", "Change specifics to ambiguities", "Consider transitions", "Courage!", "Cut a vital connection", "Decorate", "Destroy nothing; Destroy the most important thing", "Discard an axiom", "Disciplined self-indulgence", "Discover your formulas and abandon them", "Display your talent", "Distort time", "Do nothing for as long as possible", "Do something boring", "Do something sudden", "Do the last thing first", "Do the words need changing?", "Don't avoid what is easy", "Don't break the silence", "Don't stress one thing more than another", "Emphasize differences", "Emphasize the flaws", "Faced with a choice", "Find a safe part and use it as an anchor", "Give the game away", "Give way to your worst impulse", "Go outside. Shut the door.", "Go outside. Shut the door.", "Go to an extreme", "How would someone else do it?", "How would you have done it?", "In total darkness", "Is it finished?", "Is something missing?", "Is the style right?", "It is simply a matter or work", "Just carry on", "Listen to the quiet voice", "Look at the order in which you do things", "Magnify the most difficult details", "Make it more sensual", "Make what's perfect more human", "Move towards the unimportant", "Not building a wall; making a brick", "Once the search has begun", "Only a part", "Only one element of each kind", "Openly resist change", "Pae White's non-blank graphic metacard", "Question the heroic", "Remember quiet evenings", "Remove a restriction", "Repetition is a form of change", "Retrace your steps", "Reverse", "Simple Subtraction", "Slow preparation", "State the problem as clearly as possible", "Take a break", "Take away the important parts", "The inconsistency principle", "The most easily forgotten thing is the most important", "Think - inside the work -outside the work", "Tidy up", "Try faking it (from Stewart Brand)", "Turn it upside down", "Use `unqualified' people", "Use an old idea", "Use cliches", "Use filters", "Use something nearby as a model", "Use your own ideas", "Voice your suspicions", "Water", "What context would look right?", "What is the simplest solution?", "What mistakes did you make last time?", "What to increase? What to reduce? What to maintain?", "What were you really thinking about just now?", "What would your closest friend do?", "What wouldn't you do?", "When is it for?", "Where is the edge?", "Which parts can be grouped?", "Work at a different speed", "Would anyone want it?", "Your mistake was a hidden intention");

	// An integer greater or equal to 1 please!
	if (!($quantity > 0)) $quantity = 1; 
	
	// Return strateg(y|ies)
	return $oblique_strategies[array_rand($oblique_strategies, $quantity)];
}


function oblique_admin() {
	echo '<div id="oblique-stragegy"><a href="" target="_blank">Oblique Strategy</a>' . random_oblique_strategies() . '</div>';
}

function oblique_css() {

	echo '<style type="text/css">
	#oblique-stragegy {
		position: relative;
		margin: 0 0 0 50px;
		padding: 13px 0;
		font-size: 20px;
		float:left;
		text-shadow: 1px 1px 1px #ffffff;
		min-width: 100px
	}
	#oblique-stragegy a {
		position:absolute;
		bottom:-2px;
		right:-10px;
		font-size:8px;
		color:white;
		text-shadow: 1px 1px 1px #444444;
	}
	</style>';
}

//add_action('admin_footer', 'oblique_admin');
add_action('in_admin_header', 'oblique_admin');

add_action("admin_head", "oblique_css"); // admin_head

/* These functions will help us. ...... or not*/
/*function get_oblique_strategies($howmany) {
	$strategies = array();
	for ($i=0; $i < $howmany; $i++) {
		// Get a random index # for oblique strategy
		$rand = mt_rand(0, $num_oblique - 1);
		$strategies[] = $oblique_strategies[$rand];
	}
	// Return string for a single strategy, or an array of strings for > 1
	return ($howmany == 1) ? $strategies[0] : $strategies;

}
*/
