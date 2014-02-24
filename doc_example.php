<html>
<header>
<title>Error Class | Author by Hansen Wong</title>
<style>
body{
	background-color:#666;
}
h3 span{
	color:#666;
	font-size:15px;
}
h3{
	color:#55a;
}
.warp{
	margin:0px auto;
	width:800px;
	background-color:#fff;
	padding:15px;
	border-radius:10px;
}
</style>
</header>
<body>
<div class="warp">
<h1>Documentation and Example Error Class</h1>
<p>
/** Error Handling - Error Class<br />
* @author Hansen Wong, http://www.rockbeat.web.id/ | huang_hanzen@yahoo.co.id<br />
* @copyright 2014 Hansen Wong<br />
* @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0<br />
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)<br />
* @version 1.0.2<br />
*/<br />
</p>
<?php
require 'error.php';
$error = new Error();
?>
<h3>Basic Error <span>$this->set_error([text])</span></h3>
<p>
<samp>
<?php
	$error->convert = FALSE; // this will not to convert language
	$error->set_error('User Not Login');
	if(!$error->is_error){
		// do something...
	}else{
		nl2br(print_r($error->get_all()));
	}
	
	$error->clear_error();
?>
</samp>
</p>

<h3>Basic Group Error <span>$this->set_error([text/index],[replace],[group])</span></h3>
<p>
<samp>
<?php
	$error->set_error('User Not Login',null,'login_error');
	$error->set_error('Session Expire',null,'system_error');
	if(!$error->is_error){
		// do something...
	}else{
		print_r($error->get_all());
	}
	$error->clear_error();
?>
</samp>
</p>

<h3>Set Language Error <span>$this->set_lang(['data'])</span></h3>
<p>
<samp>
<?php
	// set language
	$lang = array(
		'NO_LOGIN' => 'User not login',
		'DB_ERROR' => 'Database Error'
	);
	
	$error->set_lang($lang); // initialize language
	$error->convert = TRUE;  // enable convert language
	$error->set_error('NO_LOGIN');
	$error->set_error('DB_ERROR');
	$error->set_error('NO_LANG');
	if(!$error->is_error){
		// do something...
	}else{
		print_r($error->get_all());
	}
	$error->clear_error();
?>
</samp>
</p>

<h3>Add Language and Replace <span>$this->set_error([text/index],[replace])</span></h3>
<p>
<samp>
<?php
	$lang = array(
		'EMAIL_ERROR'	=> 'email {0} not found',
		'NOT_FOUND'		=> 'index {index} not found on {page}',
	);
	$error->set_lang($lang);
	$error->set_error('EMAIL_ERROR',array('name@server.com'),'login_error');
	$error->set_error('NOT_FOUND',array('index'=>'keyword','page'=>'home'));
	$error->set_error('DB_ERROR');
	if(!$error->is_error){
		// do something...
	}else{
		print_r($error->get_all());
	}
	$error->clear_error();
?>
</samp>
</p>

<h3>Set Error without Error <span>$this->set_error([text/index],[replace],[group],[error])</span></h3>
<p>
<samp>
<?php
	$error->set_error('NOT_FOUND',array('index'=>'keyword','page'=>'home'),'info',FALSE);
	if(!$error->is_error){
		// do something...
		echo 'No Error<br />';
		print_r($error->get_error('info'));
	}else{
		// do something if error
	}
	$error->clear_error();
?>
</samp>
</p>

<h3>Set Config Group <span>$this->set_group([config])</span></h3>
<p>
if using config group to set error use function $this->set([text/index],[replace],[group_index]);
</p>
<p>
<samp>
<?php
	$group = array(
		'error' => array(
			'is_error' => TRUE
		),
		'information' => array(
			'is_error' => FALSE
		)
	);
	$error->set_group($group);
	$error->set('NOT_FOUND',array('index'=>'keyword','page'=>'home'),'info');
	
	if(!$error->is_error){
		// do something...
		echo 'No Error<br />';
	}else{
		// do something if error
	}
	print_r($error->get_error('info'));
	$error->clear_error();
?>
</samp>
</p>
<h3>Get All Error <span>$this->get_all()</span></h3>
<p>
<samp>
<?php
	$error->set_error('NO_LOGIN',null,'info_login');
	$error->set_error('DB_ERROR');
	print_r($error->get_all('info_login'));
	$error->clear_error();
?>
</samp>
</p>
<h3>Get Error Group <span>$this->get_error([group])</span></h3>
<p>Default group is "system"</p>
<p>
<samp>
<?php
	$error->set_error('NO_LOGIN',null,'info_login');
	$error->set_error('DB_ERROR');
	print_r($error->get_error('info_login'));
	$error->clear_error();
?>
</samp>
</p>
<h3>Clear Error <span>$this->clear_error([group])</span></h3>
<p>
<b>Clear All Error</b>
<samp>
$this->clear_error();
</samp><br />
<b>Clear Group Error</b>
<samp>
$this->clear_error([index group]);
</samp>
</p>

<h3>is Error <span>$this->is_error([group])</span></h3>
<p>Will return [Boolean]</p>
<p>
<b>Check main Error</b>
<samp>
$this->is_error;
</samp><br />
<b>Check all error</b>
<samp>
$this->is_error();
</samp><br />
<b>Check group Error</b>
<samp>
$this->is_error([group]); // default group 'system'
</samp><br />
</p>

<h3>Integrate with Code Igniter</h3>
<p>
Copy and paste 'error.php' to folder 'libraries/' and Initializing library $this->load->library('error') or set autoload.php file
more info <a target="_blank" href="http://ellislab.com/codeigniter/user-guide/general/autoloader.html">autoload</a>
</p>
</div>
</body>
</html>
