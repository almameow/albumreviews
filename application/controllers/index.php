<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		//define model
		$this->load->model("Album_model");

		//$this->output->enable_profiler();
	}

	public function index()
	{
		//load login view file by default
		$this->load->view("login");
	}

	public function go_home()
	{
		$id = $this->session->userdata("current_user");
		$users['user'] = $this->Album_model->get_user($id);
		$this->load->view("albums", $users);
	}

	public function login()
	{
		$login_info = $this->input->post();

		$email = $login_info['email'];
		$existing_email = $this->Album_model->get_emails($email);

		$user_login = $this->Album_model->login($login_info);

		if(!empty($login_info['email']) || !empty($login_info['pass']))//if no fields are empty
		{
			if(!empty($existing_email)) //if email is in db
			{
				if(!empty($user_login)) //if email and pass match in db
				{
					//set session variables for current user
					$this->session->set_userdata("logged_in", TRUE);
					$this->session->set_userdata("current_user", $user_login['id']);
					$users['user'] = $user_login;
					//load dashboard
					$this->load->view("albums", $users);
				}
				else
				{
					$this->session->set_flashdata("login_error", "The email and password entered do not match.");
					redirect("/");
				}
			}
			else
			{
				$this->session->set_flashdata("login_error", "A user with the email $email does not exist.");
				redirect("/");
			}
		}
		else
		{
			$this->session->set_flashdata("login_error", "All fields must be completed.");
			redirect("/");
		}

	}

	public function register()
	{
		$reg_info = $this->input->post();
		$username = $reg_info['username'];
		$existing_user = $this->Album_model->get_usernames($username);
		//var_dump($reg_info);
		if(!empty($reg_info['name']) || !empty($reg_info['username']) || !empty($reg_info['email']) || !empty($reg_info['pass']) || !empty($reg_info['confirm_pass'])) //if no field is empty
		{
			if(empty($existing_user)) //if username does not exist
			{
				if(filter_var($reg_info['email'], FILTER_VALIDATE_EMAIL)) //if email is valid
				{
					if(!empty($reg_info['pass']) && !empty($reg_info['confirm_pass'])) //if no passwords are empty
					{
						if(strlen($reg_info['pass']) > 7) //if password is at least 8 char long
						{
							if($reg_info['pass'] == $reg_info['confirm_pass']) //if passwords match
							{
								// Add new user to db
								$this->Album_model->add_new_user($reg_info);
								$this->session->set_flashdata("reg_success", "You have successfully registered! Please log in.");
								redirect("/");
							}
							else
							{
								$this->session->set_flashdata("reg_error", "Passwords do not match.");
								redirect("/");
							}
						}
						else
						{
							$this->session->set_flashdata("reg_error", "Password must be at least 8 characters long.");
							redirect("/");	
						}
					}
					else
					{
						$this->session->set_flashdata("reg_error", "Passwords cannot be blank.");
							redirect("/");
					}
				}
				else
				{
					$this->session->set_flashdata("reg_error", "Please enter a valid email address.");
					redirect("/");
				}
			}
			else
			{
				$this->session->set_flashdata("reg_error", "The username $username exists.");
				redirect("/");
			}
		}
		else
		{
			$this->session->set_flashdata("reg_error", "All fields must be completed.");
			redirect("/");
		}
	}
	public function logout()
	{
		$this->session->set_userdata("logged_in", FALSE);
		redirect("/");
	}
}

//end of main controller