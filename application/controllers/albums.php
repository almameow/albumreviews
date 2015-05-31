<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Albums extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Album_model");
		//$this->output->enable_profiler();
	}

	public function add()
	{
		$id = $this->session->userdata("current_user");
		$users['user'] = $this->Album_model->get_user($id);
		$this->load->view("add", $users);
	}

	public function get_recent_reviews()
	{
		$recent_reviews['reviews'] = $this->Album_model->get_recent_reviews();
		// Load partial
		$this->load->view("partials/recent_reviews", $recent_reviews);
	}

	public function get_all_reviews()
	{
		$all_reviews['reviews'] = $this->Album_model->get_all_reviews();
		// Load partial
		$this->load->view("partials/all_reviews", $all_reviews);
	}

	public function add_album_review()
	{
		$new_album = $this->input->post();
		$new_album['user_id'] = $this->session->userdata("current_user");
		//var_dump($new_album);

		////// if existing artist, do same function as adding new artist (save over any existing reviews by same user)


		// If all fields (except artist/artist2) entered (rating automatically set to 1)
		if(!empty($new_album['title']) || !empty($new_album['review'] )) 
		{
			// If only one of the artist fields is entered 
			if(!(empty($new_album['artist']) && empty($new_album['artist2'])) || (!empty($new_album['artist']) && empty($new_album['artist2'])))
			{
				// If adding a new artist
				if(!empty($new_album['artist2'])) 
				{
					$this->Album_model->add_album_and_artist($new_album);
					$albums['album'] = $new_album;

					$title = $new_album['title'];
					$artist = $new_album['artist2'];
					$this->session->set_flashdata("add_success", "Your review for the newly added album $title by $artist has been successfully added.");
					redirect("/albums/add");
				}
				// Adding a review for an existing artist (on drop down list)
				else 
				{
					$this->Album_model->add_album($new_album);
					$albums['album'] = $new_album;

					$title = $new_album['title'];
					$artist = $new_album['artist'];
					$this->session->set_flashdata("add_success", "Your review for the newly added album $title by $artist has been successfully added.");
					redirect("/albums/add");

					//$album_id = $this->Album_model->get_album_id($new_album); why am i calling this here?
					// $this->Album_model->add_album_only($new_album);

					// $title = $new_album['title'];
					// $artist = $new_album['artist'];
					// $new_album['album_id'] = $album_id['id'];

					///check is user has already reviewed this album
					//$user_has_reviewed = $this->Album_model->get_user_reviewed($new_album);

					//if user has already reviewed this album
					// if(!empty($user_has_reviewed)) 
					// {
					// 	$this->session->set_flashdata("add_error", "You have already reviewed this album.");
					// 	redirect("/albums/add");
					// }
					// else //user has not yet reviewed this album
					// {
					// 	$this->Album_model->add_review($new_album);
					// 	$albums['album'] = $new_album;

					// 	$title = $new_album['title'];
					// 	$artist = $new_album['artist'];
					// 	$this->session->set_flashdata("add_success", "Your review for the album $title by $artist  has been successfully added.");
					// 	redirect("/albums/add");
					// }
				}
				
			}
			// Else both or neither artist field entered
			else 
			{
				$this->session->set_flashdata("add_error", "You must enter only one artist name.");
				redirect("/albums/add");
			}
		}
		//Else not all fields entered
		else 
		{
			$this->session->set_flashdata("add_error", "All fields must be completed.");
			redirect("/albums/add");
		}

	}

	public function get_all_artists()
	{
		$all_artists['artists'] = $this->Album_model->get_all_artists();
		$this->load->view("partials/all_artists", $all_artists);
	}

	public function show_album($id) //Link from album title to full album description
	{
		$all_reviews['reviews'] = $this->Album_model->get_album_info($id);
		$this->session->set_userdata("current_album_id", $id);
		$this->load->view("show_album", $all_reviews);
	}

	public function get_reviews_per_album()
	{
		$all_reviews['reviews'] = $this->Album_model->get_reviews_per_album($this->session->userdata("current_album_id"));
		//var_dump($all_reviews);
		$this->load->view("partials/all_reviews_per_album", $all_reviews);
	}


}