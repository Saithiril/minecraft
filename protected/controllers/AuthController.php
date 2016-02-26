<?php
include "Controller.php";
include "User.php";

class AuthController extends Controller
{
	private function checkPasswords($trypass,$realpass){
		$parts = explode('$',$realpass);
		$salt = $parts[2];
		$hashed = hash('sha256',hash('sha256', $trypass).$salt);
		$hashed = '$SHA$'.$salt.'$'.$hashed;
		return $hashed == $realpass ? true : false;
	}

	public function indexAction() {
		$this->render("index");
	}

	public function userAddAction() {
		if(isset($_POST['username']) && isset($_POST['password'])) {
			$user = User::model()->find("name=:username", array(':username' => $_POST['username']));
			if ($user->name && $this->checkPasswords($_POST['password'], $user->pass)) {
				$_SESSION['user'] = array(
					'id' => $user->id,
					'username' => $user->name,
					'role_id' => $user->role_id
				);
				$this->redirect('/');
			}
		}
		$this->render("index");
	}

	public function logoutAction() {
		if(isset($_SESSION['user'])) {
			unset($_SESSION['user']);
		}
		$this->redirect('/');
	}
}