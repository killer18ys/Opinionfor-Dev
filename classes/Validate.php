<?php 
class Validate{
	private $_passed = false,
			$_errors = array(),
			$_db = null;

	public function __construct(){
		$this->_db = DB::getInstance();
	}

	public function check($source, $items = array()){
		$translateArr = [
			'category' => "категорията",
			'opinion-field' => "полето за мнение",
			'item-name' => "името на обекта",
			'q1' => "въпрос едно",
			'q2' => "въпрос две",
			'q3' => "въпрос три",
			'q4' => "въпрос четири",
			'q5' => "въпрос пет",
			'username' => "потребителското име",
			'email' => "имейл адреса",
			'password' => "паролата",
			'password_again' => "повтарянето на паролата",
			'password_current' => "настоящата ви паролата",
			'password_new' => "новата ви паролата",
			'password_new_again' => "повтарянето на новата ви парола",
		];

		foreach ($items as $item => $rules) {
			foreach ($rules as $rule => $rule_value) {

				$value = isset($_POST[$item]) ? trim($source[$item]) : '';
				$item = escape($item);

				if ($rule === 'required' && empty($value)) {
						$this->addError("{$translateArr[$item]} е задължително");
				}else if(!empty($value)){
					switch($rule){
						case 'min':
							if (strlen($value) < $rule_value) {
								$this->addError("{$translateArr[$item]} трябва да е най-малко {$rule_value} символа.");
							}
							break;
						case 'max':
							if (strlen($value) > $rule_value) {
								$this->addError("{$translateArr[$item]} трябва да е най-много {$rule_value} символа.");
							}									
							break;
						case 'matches':
								if ($value != $source[$rule_value]) {
									$this->addError("{$rule_value} трябва да съвпада с {$translateArr[$item]}");
								}
							break;
						case 'uniqe':
								$check = $this->_db->get($rule_value, array($item, '=', $value));
								if ($check->count()) {
									$this->addError("{$translateArr[$item]} вече съществува.");
								}
							break;
					}
				}
			}
		}

		if (empty($this->_errors)) {
			$this->_passed = true;
		}

		return $this;
	}

	private function addError($error){
		$this->_errors[] = $error;
	}

	public function errors(){
		return $this->_errors;
	}
	public function passed(){
		return $this->_passed;
	}
}


