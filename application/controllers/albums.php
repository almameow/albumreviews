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
		
		// If all fields are entered (rating automatically set to 1)
		if(!empty($new_album['title']) && !empty($new_album['review'])) 
		{
			// If user selected AND entered an artist
			if(!empty($new_album['artist1']) && !empty($new_album['artist']))
			{
				$this->session->set_flashdata("add_error", "You can only enter one artist name.");
		 		redirect("/albums/add");
			}
			// Only one artist entered
			else
			{
				// If artist1 entered
				if(!empty($new_album['artist1']))
				{
					$album_exists = $this->Album_model->get_album_id($new_album);

					// If this album+artist exists in db
					if($album_exists)
					{
						//save album's id to $new_album
						$new_album['album_id'] = $album_exists['id'];
						$user_has_reviewed = $this->Album_model->get_user_reviewed($new_album);

						// If user has already reviewed this album
						if($user_has_reviewed)
						{
							//update their existing review
							$new_album['user_review_id'] = $user_has_reviewed['id'];
							$this->Album_model->update_existing_review($new_album);

							$title = $new_album['title'];
							$artist = $new_album['artist1'];
							$this->session->set_flashdata("add_success", "Your review for the album $title by $artist has been successfully updated.");
							redirect("/albums/add");
						}
						// User hasn't yet reviewed this exisiting album/artist
						else
						{
							//add their review
							$this->Album_model->add_review_existing_album($new_album);

							$title = $new_album['title'];
							$artist = $new_album['artist1'];
							$this->session->set_flashdata("add_success", "Your review for the album $title by $artist has been successfully added.");
							redirect("/albums/add");
						}
					}
					// Add new review for album+artist not in db
					else
					{
						$this->Album_model->add_album_and_artist($new_album);

						$title = $new_album['title'];
						$artist = $new_album['artist1'];
						$this->session->set_flashdata("add_success", "Your review for the album $title by $artist has been successfully added.");
						redirect("/albums/add");
					}
				}
				// Else artist entered
				else
				{
					$new_album['artist1'] = $new_album['artist'];
					//add review to db
					$this->Album_model->add_album_and_artist($new_album);

					$title = $new_album['title'];
					$artist = $new_album['artist1'];
					$this->session->set_flashdata("add_success", "Your review for the newly created album $title by $artist has been successfully added.");
					redirect("/albums/add");
				}
			}
		}	
		// Else not all fields entered
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

	//Link from album title to full album description
	public function show_album($id)
	{
		$all_reviews['reviews'] = $this->Album_model->get_album_info($id);
		$user_id['name'] = $this->session->userdata("current_user");
		$all_reviews['user'] = $this->Album_model->get_user($user_id);

		$this->session->set_userdata("current_album_id", $id);
		$this->load->view("show_album", $all_reviews);
	}

	public function get_reviews_per_album()
	{
		$all_reviews['reviews'] = $this->Album_model->get_reviews_per_album($this->session->userdata("current_album_id"));
		$this->load->view("partials/all_reviews_per_album", $all_reviews);
	}

	public function add_review_to_album()
	{
		$new_review = $this->input->post();
		$new_review['user_id'] = $this->session->userdata("current_user");
		$new_review['album_id'] = $this->session->userdata("current_album_id");

		$user_has_reviewed = $this->Album_model->get_user_reviewed($new_review);
		//If user has already reviewed this album
		if($user_has_reviewed)
		{
			// Update their review
			$new_review['user_review_id'] = $user_has_reviewed['id'];
			$this->Album_model->update_existing_review($new_review);

			// Reload page with updated review
			$id = $new_review['album_id'];
			$all_reviews['reviews'] = $this->Album_model->get_album_info($id);
			$user_id['name'] = $this->session->userdata("current_user");
			$all_reviews['user'] = $this->Album_model->get_user($user_id);
			$this->session->set_userdata("current_album_id", $id);
			$this->load->view("show_album", $all_reviews);
		}	
		// User has not reviewed this album
		else
		{
			//add user's review
			$this->Album_model->add_review_existing_album($new_review);

			// Reload page with new review
			$id = $new_review['album_id'];
			$all_reviews['reviews'] = $this->Album_model->get_album_info($id);
			$user_id['name'] = $this->session->userdata("current_user");
			$all_reviews['user'] = $this->Album_model->get_user($user_id);
			$this->session->set_userdata("current_album_id", $id);
			$this->load->view("show_album", $all_reviews);
		}
			
	}


}