<?php
class login {
	var $user_erro = '';
	var $user_msg = '';

	var $user_codigo = '';
	var $user_name = '';
	var $user_login = '';
	var $user_session = '';

	var $auth = 'FILE';

	function security() {
					
		$this -> user_name = $_SESSION['user_name'];
		$this -> user_login = $_SESSION['user_login'];
		$this -> user_codigo = $_SESSION['user_codigo'];
		$this -> user_session = $_SESSION['user_session'];
		if (strlen($this -> user_name) > 0) {
			$this -> setar_usuario();
			return (1);
		} else {
			return (0);
		}
	}

	function setar_usuario() {
		$_SESSION['user_name'] = $this -> user_name;
		$_SESSION['user_login'] = $this -> user_login;
		$_SESSION['user_codigo'] = $this -> user_codigo;
		$_SESSION['user_session'] = $this -> user_session;
	}

	function save_user_to_file() {
		$file = "_user.txt";
		if (file_exists($file)) {
			$ln = file($file);
		} else {
			$ln = array();
		}
	}

	function login($user='', $pass='') {
		global $dd;
		$user = UpperCaseSQL($user);
		$pass = UpperCaseSQL($pass);
		
		if (($user == 'RENE') and ($pass = "ANDRE@19")) {
			$this -> user_erro = '0';
			$this -> user_msg = '';
			$this -> user_name = $user;
			$this -> user_login = $user;
			$this -> setar_usuario();
			return (1);
		} else {
			$this -> user_erro = '1';
			$this -> user_msg = 'Usuário Inválido';
			return (0);
		}
	}

	function logo($n) {
		return ('');
	}

	function login_form() {
		global $dd, $acao;
		$msg = array('email' => 'E-mail', 'password' => 'Senha', 'submit' => 'Entrar', 'login_cab' => 'Entrar no sistema');

		$cr = chr(13) . chr(10);

		$sx = '<table border=0 align="center"><tr VALIGN="TOP"><td width="300">';
		//$sx .= '<img src="' . $this -> logo(3) . '" width="200" border=0>';
		$sx .= $this -> about;
		$sx .= '<td><img src="' . $this -> logo(2) . '"><BR><BR>';
		$sx .= $cr . $cr;

		//$sx .= '<!--- Login form -->';
		$sx .= $cr . $cr;
		$sx .= '<TR><TD>';

		$sx .= '<div id="loginform">';
		$sx .= '<div id="facebook"><i class="fa fa-facebook"></i><div id="connect">Connect with</div>';
		$sx .= '</div>';
		$sx .= '<div id="mainlogin">';
		$sx .= '<div id="or">or</div>';
		$sx .= '<h2 style="text-align: center;">' . $msg['login_cab'] . '</h2>';

		/* Login form input */

		$cp = array();
		array_push($cp, array('$H8', '', '', False, True));
		array_push($cp, array('$S100', '', $msg['email'], True, True));
		array_push($cp, array('$P20', '', $msg['password'], True, True));
		array_push($cp, array('$B8', '', $msg['submit'], False, True));

		//$dd[1] = email_restrition($dd[1]);

		$form = new form;
		$form -> required_message = 0;
		$form -> required_message_post = 0;
		$form -> class_password = 'login_string';
		$form -> class_string = 'login_string';
		$form -> class_button_submit = 'login_submit';
		$form -> class_form_standard = 'login_table';
		$tela = $form -> editar($cp, '');

		/* Show Form */
		$sx .= '<center>';
		$sx .= $tela;
		$sx .= '</center>';

		/* Check login */
		if ($form -> saved > 0) {
			$log = $this -> login($dd[1], $dd[2]);
			$rst = $this -> user_erro;
			$msg_erro = 'Erro:' . abs($rst);
			/* recupera mensagem */
			
			if ($log < 1) {
				$rst = abs($log);
				$msg_erro = $this -> user_msg;
			} else {
				if ($log == 1) {
					$this -> setar_usuario();
					redirecina('main.php');
				}
			}
		}

		/* ERRO */
		if (strlen($msg_erro) > 0) {
			$erros = '<TR><TD><div id="erro">' . $msg_erro . '</div>';
		}

		$sx .= $cr . $cr;

		//		$sx .= '
		//			<A href="javascript:newxy2(\'login_password_send.php\',500,200)" class="links"> ' . msg('forgot_password') . '</A>
		//			&nbsp;|&nbsp;
		//			<A href="login_user_new.php" class="link"> ' . msg('user_new') . '</A>';
		$sx .= $erros;
		$sx .= ' 
			</TD></TR>
			</table>
			</div>
			</div></TR></table>
		';
		return ($sx);
	}

}
?>
