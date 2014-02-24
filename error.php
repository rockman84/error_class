<?php
/** Error Handling - Error Class
* @author Hansen Wong, huang_hanzen@yahoo.co.id
* @copyright 2014 Hansen Wong
* @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
* @version 1.0.2
*/

class Error {
private $config = array(
	'system'	=> array(
		'set_error' => TRUE,
	)
);
private $lang = array(
	'E_CONFIG_NOT_FOUND' => 'Error config with index ["{0}"] not found'
);
public $error = array();
public $is_error = FALSE;
public $total_error = 0;
public $convert = TRUE;
	
	public function set_group($config){
		$this->config = array_merge($this->config,$config);
	}
	
	public function set_lang($data){
		$this->lang = array_merge($this->lang,$data);
	}
	
	public function set($string, $replace = null, $index = 'system'){
		if(isset($this->config[$index])){
			$setup = $this->config[$index];
			$this->set_error($string,$replace,$index,$setup['set_error']);
		}
		else{
			$this->set_error($string,$replace,$index);
			$this->set_error('E_CONFIG_NOT_FOUND',array($index));
		}
	}
	
	public function set_error($string, $replace = null, $group = 'system', $error = TRUE){
		$this->error[$group][] = $this->replace($this->convert($string),$replace);
		$this->total_error = $this->total_error + 1;
		$this->is_error = $error;
	}
	
	public function clear_error($group = 'all'){
		if($group == 'all'){
			$this->error = array();
			$this->is_error = FALSE;
			$this->total_error = 0;
		}
		else{
			$count = count($this->error[$group]);
			unset($this->error[$group]);
			$this->total_error = $this->total_error - $count;
		}
	}
	
	public function is_error($group){
		if(count($this->error[$group]) > 0){
			return TRUE;
		}
	}
	
	public function get_error($group = 'system'){
		if(!isset($this->error[$group])){
			$error = array();
		}
		else{
			$error = $this->error[$group];
		}
		$result = array(
			'error' => $error,
			'group'	=> $group,
			'is_error' => $this->is_error,
			'total' => count($error)
		);
		return $result;
	}
	
	public function get_all(){
		$result = array(
			'error' => $this->error,
			'is_error' => $this->is_error,
			'total' => $this->total_error
		);
		return $result;
	}
	
	protected function convert($source){
		if($this->convert){
			if(isset($this->lang[$source])){
				$source = $this->lang[$source];
			}
			else{
				$source = '['.$source.'] (Missing Language*)';
			}
		}
		return $source;
	}
	
	protected function replace($string,$replace){
		if(is_array($replace)){
			foreach($replace as $name => $val){
				$word['find'][]= '{'.$name.'}';
				$word['replace'][] = $val;
			}
			return str_replace($word['find'],$word['replace'],$string);
		}
		else{
			return $string;
		}
	}
}
/** End of Error Class **/
?>
