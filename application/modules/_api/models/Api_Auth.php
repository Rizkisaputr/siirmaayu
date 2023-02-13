<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Api_Auth
 * @property CI_DB_query_builder $db
 * @property Ion_auth_model $ion_auth_model
 * @property User_model $User_model
 */

class Api_Auth extends Ion_auth_model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function api_login($identity, $password)
	{
		$this->trigger_events('pre_login');

		if (empty($identity) || empty($password))
		{
			$this->set_error('login_unsuccessful');
			return FALSE;
		}

		$this->trigger_events('extra_where');

		$query = $this->db->select($this->identity_column . ', email, id, password, active, last_login')
			->where($this->identity_column, $identity)
			->limit(1)
			->order_by('id', 'desc')
			->get($this->tables['users']);

		if ($this->is_max_login_attempts_exceeded($identity))
		{
			// Hash something anyway, just to take up time
			$this->hash_password($password);

			$this->trigger_events('post_login_unsuccessful');
			$this->set_error('login_timeout');

			return FALSE;
		}

		if ($query->num_rows() === 1)
		{
			$user = $query->row();

			$password = $this->hash_password_db($user->id, $password);

			if ($password === TRUE)
			{
				if ($user->active == 0)
				{
					$this->trigger_events('post_login_unsuccessful');
					$this->set_error('login_unsuccessful_not_active');

					return FALSE;
				}

				$this->update_last_login($user->id);

				$this->clear_login_attempts($identity);

				$this->trigger_events(array('post_login', 'post_login_successful'));
				$this->set_message('login_successful');

				//because api login didn't save session return uid
				return $user;
			}
		}

		// Hash something anyway, just to take up time
		$this->hash_password($password);

		$this->increase_login_attempts($identity);

		$this->trigger_events('post_login_unsuccessful');
		$this->set_error('login_unsuccessful');

		return FALSE;
	}

	public function detil_user($uid){
		$user=$this->user($uid)->row();
		if(!$user)
			return false;
		$this->load->model('User_model');
		$id_rss=$this->User_model->get_all_user_rs($uid);
		$user->permission=(object)array(
			'admin'	=> $id_rss===TRUE,
			'rs'	=> $id_rss===TRUE?NULL:$id_rss
		);
		return $user;
	}
}
