<?php
include "Controller.php";
include "User.php";
include "Eco.php";
include "Permission.php";
include "PermissionsInheritance.php";

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
  
  // Следующий бред написал я:
  public function userInfoAction(){
  include "worlds.php";
	if(isset($_SESSION['user'])) {
		$user = User::model()->find_by_pk($_SESSION['user']['id']);
    $eco = Eco::model()->find('account=:account', array(':account' => $_SESSION['user']['username']));
    $perm = Permission::model()->find('permission=:perm AND value=:name', array(':perm' => 'name', ':name'=> $_SESSION['user']['username']));
    $perms = PermissionsInheritance::model()->find('child=:child', array(':child'=>$perm->name));
    
    $lastlogin=date("Y-m-d H:i:s", ($user->lastlogin/1000));
    
		$data = array(
			'name' => $user->name,
			'mail' => $user->mail,
			'lastlogin' => $lastlogin,
      'isLogged' => $user->isLogged,
      'x' => $user->x,
      'y' => $user->y,
      'z' => $user->z,
      'world' => $wn[mb_strtolower($user->world)],
      'balance' => $eco->balance,
      'currency' => $eco->currency,
      'parent' => $perms->parent
      );
  		$this->render("user", $data);
	}
  }
  
  
  
}
