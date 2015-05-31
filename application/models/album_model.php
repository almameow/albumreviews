<?php  
	if(!defined('BASEPATH')) exit('No direct script access allowed');

	class Album_model extends CI_Model{
		// LOGIN PAGE //
		public function add_new_user($user)
		{
			return $this->db->query("INSERT INTO users (name, username, email, password, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())", array($user['name'], $user['username'], $user['email'], $user['pass']));
		}

		public function get_usernames($username)
		{
			return $this->db->query("SELECT username FROM users WHERE username = ?", $username) ->row_array();
		}

		public function get_user($id)
		{
			return $this->db->query("SELECT * FROM users WHERE id = ?", $id)->row_array();
		}

		public function get_emails($email)
		{
			return $this->db->query("SELECT email FROM users WHERE email = ?", $email) -> row_array();
		}

		public function login($login_info)
		{
			return $this->db->query("SELECT * FROM users WHERE email = ? AND password = ?", array($login_info['email'], $login_info['pass'])) -> row_array();
		}

		// HOME PAGE //
		public function get_recent_reviews()
		{
			return $this->db->query("SELECT albums.title, albums.artist, albums.id as album_id, 
				users.name, users.username, users.id as user_id, 
				reviews.review, reviews.rating, reviews.created_at 
				FROM reviews 
				LEFT JOIN albums
				ON reviews.album_id = albums.id
				LEFT JOIN users
				ON reviews.user_id = users.id
				WHERE reviews.created_at BETWEEN 01-01-2001 AND NOW() 
				ORDER BY reviews.created_at DESC
				LIMIT 5;")->result_array();
		}

		public function get_all_reviews()
		{
			return $this->db->query("SELECT albums.title, albums.artist, albums.id as album_id, reviews.id as review_id 
				FROM reviews
				LEFT JOIN albums 
				ON reviews.album_id = albums.id
				GROUP BY albums.title;")->result_array();
		}

		// ADD ALBUM AND REVIEW PAGE // 
		public function get_all_artists()
		{
			return $this->db->query("SELECT artist FROM albums GROUP BY artist") -> result_array();
		}

		public function add_album_and_artist($new_album) 
		{
			$this->db->query("INSERT INTO albums (title, artist, created_at, updated_at) VALUES (?, ?, NOW(), NOW())", array($new_album['title'], $new_album['artist2']));

			return $this->db->query("INSERT INTO reviews (user_id, album_id, review, rating, created_at, updated_at) VALUES (?, last_insert_id(), ?, ?, NOW(), NOW())", array($new_album['user_id'], $new_album['review'], $new_album['rating']));
		}
		public function add_album($new_album) 
		{
			$this->db->query("INSERT INTO albums (title, artist, created_at, updated_at) VALUES (?, ?, NOW(), NOW())", array($new_album['title'], $new_album['artist']));

			return $this->db->query("INSERT INTO reviews (user_id, album_id, review, rating, created_at, updated_at) VALUES (?, last_insert_id(), ?, ?, NOW(), NOW())", array($new_album['user_id'], $new_album['review'], $new_album['rating']));
		}

		public function get_album_id($new_album)
		{
			return $this->db->query("SELECT albums.id FROM albums WHERE title = ? AND artist = ?", array($new_album['title'], $new_album['artist']))->row_array();
		}

		public function get_user_reviewed($new_album)
		{
			return $this->db->query("SELECT id FROM reviews WHERE user_id = ? AND album_id = ?", array($new_album['user_id'], $new_album['album_id']))->row_array();
		}

		public function get_album_info($id)
		{
			return $this->db->query("SELECT * FROM albums WHERE id = ?", $id) ->row_array();
		}

		public function add_review($new_album)
		{
			return $this->db->query("INSERT INTO reviews (user_id, album_id, review, rating, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW());", array($new_album['user_id'], $new_album['album_id'], $new_album['review'], $new_album['rating']));
		}

		// SHOW ALBUM PAGES //
		public function get_reviews_per_album($id)
		{
			return $this->db->query("SELECT reviews.review, reviews.rating, reviews.created_at, users.username, users.id as user_id, albums.title, albums.artist FROM reviews
				LEFT JOIN albums ON reviews.album_id = albums.id
				LEFT JOIN users ON reviews.user_id = users.id
				WHERE albums.id = ?
				ORDER BY reviews.created_at DESC", $id) ->result_array();
		}
	}
?>