<?php
	class Band_model extends CI_Model {

		public function __construct()
		{
			$this->load->database();
			$this->load->library('email');
		}

		public function get_bands()
		{
				$query = $this->db->query("SELECT * FROM band");
				return $query->result_array();
		}
		public function set_bands()
		{
			$data = array(
				'bandname' => $this->input->post('bandName'),
				'website'  => $this->input->post('website'),
				'wikipedia' => $this->input->post('wikipedia')	
				);

			return $this->db->insert('band',$data); 
		}
		public function delete_bands_page($data)
		{
			$this->db->SELECT('*');
			$this->db->FROM('band');
			$this->db->where('id', $data);
			$query = $this->db->get();
			$result = $query->result();
			return $result;

		}
		public function delete_bands($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('band');
		}

		public function update_bands_page($data)
		{
			$this->db->SELECT('*');
			$this->db->FROM('band');
			$this->db->where('id', $data);
			$query = $this->db->get();
			$result = $query->result();
			return $result;
		}
		public function update_bands($id,$data)
		{
			$this->db->where('id', $id);
			$this->db->update('band', $data);
		}

		//from here only ->user<- data is used, i don't believe it's needed to make a new model just for this.

		public function register_user($data)
		{
			$passHashed = password_hash($data['userPass'],PASSWORD_DEFAULT);
			$data['userPass'] = $passHashed;

			$condition = "userName =" . "'" . $data['userName'] . "'";
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where($condition);
			$this->db->limit(1);
			$query = $this->db->get();

			if($query->num_rows() == 0)
			{
				$this->db->insert('users', $data);
				return TRUE;
			}
			else {
				return FALSE;
			}
		}

		public function verify_user($email)
		{
			$data = array('is_verified' => 1);
			$this->db->where('email', $email);
			$this->db->update('users', $data);
		}

		public function login_user($data)
		{
			$condition = "userName =" . "'" . $data['userName'] . "'";
			
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where($condition);
			$this->db->limit(1);
			$query = $this->db->get();
			$result = $query->result();

			$dbPass = $result[0]->userPass;
			$dbUser = $result[0]->userName;
			var_dump($dbUser);

			if($data['userName'] == $dbUser)
			{
				$usercheck = true;
			}
			else
			{
				$usercheck = false;
			}

			if (password_verify($data['userPass'], $dbPass))
			{
				$passcheck = true;
			} 
			else 
			{
				$passcheck = false;
			}

			if($usercheck == true && ($passcheck == true))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		public function send_mail($data)
		{
			var_dump($data);
			//Standard variables.
			$from_email = 'stefanlol11@hotmail.com';
			$to_email = $data['userEmail'];
			$subject = 'Verify you email adress';
			$message = 'Hello'. $data['userName'] . ' "\r\n"
			Thanks for registering! In order to complete the registration you need to verify this email. "\r\n"
			Just click the link below and you are done:
			'. base_url().'index.php/user/register_verify?email='. $to_email. '&hash=' . $this->data['hash'];

			//configuration of the mail.
			$config['protocol'] = 'smtp';
        	$config['smtp_host'] = 'ssl://smtp.mydomain.com'; //smtp host name
        	$config['smtp_port'] = '465'; //smtp port number
       		$config['smtp_user'] = $from_email;
	        $config['smtp_pass'] = '********'; //$from_email password
	        $config['mailtype'] = 'html';
	        $config['charset'] = 'iso-8859-1';
	        $config['wordwrap'] = TRUE;
	        $config['newline'] = "\r\n"; //use double quotes
	        $this->email->initialize($config);

	        //send the mail.
		    $this->email->from($from_email, 'Mydomain');
	        $this->email->to($to_email);
	        $this->email->subject($subject);
	        $this->email->message($message);
	        return $this->email->send();
	    }
	}
