<?php
class ModelMpcheckoutSociallogin extends Model {
	public function getSocialCustomer($email) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row;
	}	

	public function addSocialCustomer($data) {
		if ($this->config->get('fblogin_customer_group')) {
			$customer_group_id = $this->config->get('fblogin_customer_group');
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$customer_data = array(
			'customer_group_id'		=> $customer_group_id,
			'firstname'				=> isset($data['firstname']) ? $data['firstname'] : '',
			'lastname'				=> isset($data['lastname']) ? $data['lastname'] : '',
			'email'					=> isset($data['email']) ? $data['email'] : '',
			'telephone'				=> isset($data['telephone']) ? $data['telephone'] : '',
			'fax'					=> isset($data['fax']) ? $data['fax'] : '',
			'company'				=> isset($data['company']) ? $data['company'] : '',
			'address_1'				=> isset($data['address_1']) ? $data['address_1'] : '',
			'address_2'				=> isset($data['address_2']) ? $data['address_2'] : '',
			'city'					=> isset($data['city']) ? $data['city'] : '',
			'postcode'				=> isset($data['postcode']) ? $data['postcode'] : '',
			'country_id'			=> isset($data['country_id']) ? $data['country_id'] : '',
			'zone_id'				=> isset($data['zone_id']) ? $data['zone_id'] : '',
			'password'				=> '123456xxxxx',
		);

		// Add Default Customer
		$this->load->model('account/customer');

		$customer_id = $this->addCustomer($customer_data);

		return $customer_id;
	}

	public function editToken($customer_id, $token) {
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET token = '" . $this->db->escape($token) . "' WHERE customer_id = '" . (int)$customer_id . "'");
	}

	public function addCustomer($data) {
		if (isset($data['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($data['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $data['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$this->load->model('account/customer_group');
		$customer_group_info = $this->model_account_customer_group->getCustomerGroup($customer_group_id);

		$this->db->query("INSERT INTO " . DB_PREFIX . "customer SET customer_group_id = '" . (int)$customer_group_id . "', store_id = '" . (int)$this->config->get('config_store_id') . "', language_id = '" . (int)$this->config->get('config_language_id') . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "', custom_field = '" . $this->db->escape(isset($data['custom_field']['account']) ? json_encode($data['custom_field']['account']) : '') . "', salt = '" . $this->db->escape($salt = token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', newsletter = '" . (isset($data['newsletter']) ? (int)$data['newsletter'] : 0) . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', status = '1', approved = '" . (int)!$customer_group_info['approval'] . "', date_added = NOW()");

		$customer_id = $this->db->getLastId();

		$address_id = 0;
		if(!empty($data['country_id'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "address SET customer_id = '" . (int)$customer_id . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', company = '" . $this->db->escape($data['company']) . "', address_1 = '" . $this->db->escape($data['address_1']) . "', address_2 = '" . $this->db->escape($data['address_2']) . "', city = '" . $this->db->escape($data['city']) . "', postcode = '" . $this->db->escape($data['postcode']) . "', country_id = '" . (int)$data['country_id'] . "', zone_id = '" . (int)$data['zone_id'] . "', custom_field = '" . $this->db->escape(isset($data['custom_field']['address']) ? json_encode($data['custom_field']['address']) : '') . "'");
			$address_id = $this->db->getLastId();
		} 

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int)$address_id . "' WHERE customer_id = '" . (int)$customer_id . "'");

		$this->load->language('mail/customer');

		$subject = sprintf($this->language->get('text_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));

		$message = sprintf($this->language->get('text_welcome'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')) . "\n\n";

		if (!$customer_group_info['approval']) {
			$message .= $this->language->get('text_login') . "\n";
		} else {
			$message .= $this->language->get('text_approval') . "\n";
		}

		$message .= $this->url->link('account/login', '', true) . "\n\n";
		$message .= $this->language->get('text_services') . "\n\n";
		$message .= $this->language->get('text_thanks') . "\n";
		$message .= html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8');

		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		$mail->setTo($data['email']);
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
		$mail->setSubject($subject);
		$mail->setText($message);
		$mail->send();

		// Send to main admin email if new account email is enabled
		if (in_array('account', (array)$this->config->get('config_mail_alert'))) {
			$message  = $this->language->get('text_signup') . "\n\n";
			$message .= $this->language->get('text_website') . ' ' . html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8') . "\n";
			$message .= $this->language->get('text_firstname') . ' ' . $data['firstname'] . "\n";
			$message .= $this->language->get('text_lastname') . ' ' . $data['lastname'] . "\n";
			$message .= $this->language->get('text_customer_group') . ' ' . $customer_group_info['name'] . "\n";
			$message .= $this->language->get('text_email') . ' '  .  $data['email'] . "\n";
			$message .= $this->language->get('text_telephone') . ' ' . $data['telephone'] . "\n";

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($this->config->get('config_email'));
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(html_entity_decode($this->language->get('text_new_customer'), ENT_QUOTES, 'UTF-8'));
			$mail->setText($message);
			$mail->send();

			// Send to additional alert emails if new account email is enabled
			$emails = explode(',', $this->config->get('config_alert_email'));

			foreach ($emails as $email) {
				if (utf8_strlen($email) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$mail->setTo($email);
					$mail->send();
				}
			}
		}

		return $customer_id;
	}
	/*new updates 28032018 starts*/
	public function getMpSocialLoginFbUser($id, $username) {
		$query = $this->db->query("SELECT * FROM ". DB_PREFIX ."mpsociallogin WHERE id='". $this->db->escape($id) ."' AND username='". $this->db->escape($username) ."' AND type='FB'");
		return $query->row;
	}

	public function addMpSocialLoginFbUser($id, $username) {
		$this->db->query("INSERT INTO ". DB_PREFIX ."mpsociallogin SET id='". $this->db->escape($id) ."', username='". $this->db->escape($username) ."', type='FB', date_added=NOW()");
	}

	public function addCustomerIdToFbUser($id, $customer_id) {
		$this->db->query("UPDATE ". DB_PREFIX ."mpsociallogin SET customer_id='". (int)$customer_id ."', date_modified=NOW() WHERE id='". $this->db->escape($id) ."' AND type='FB'");
	}
	public function getMpSocialLoginInstaUser($id, $username) {
		$query = $this->db->query("SELECT * FROM ". DB_PREFIX ."mpsociallogin WHERE id='". $this->db->escape($id) ."' AND username='". $this->db->escape($username) ."' AND type='INSTAGRAM'");
		return $query->row;
	}

	public function addMpSocialLoginInstaUser($id, $username) {
		$this->db->query("INSERT INTO ". DB_PREFIX ."mpsociallogin SET id='". $this->db->escape($id) ."', username='". $this->db->escape($username) ."', type='INSTAGRAM', date_added=NOW()");
	}

	public function addCustomerIdToInstaUser($id, $customer_id) {
		$this->db->query("UPDATE ". DB_PREFIX ."mpsociallogin SET customer_id='". (int)$customer_id ."', date_modified=NOW() WHERE id='". $this->db->escape($id) ."' AND type='INSTAGRAM'");
	}

	public function getMpSocialLoginTwitterUser($id, $username) {
		$query = $this->db->query("SELECT * FROM ". DB_PREFIX ."mpsociallogin WHERE id='". $this->db->escape($id) ."' AND username='". $this->db->escape($username) ."' AND type='TWITTER'");
		return $query->row;
	}

	public function addMpSocialLoginTwitterUser($id, $username) {
		$this->db->query("INSERT INTO ". DB_PREFIX ."mpsociallogin SET id='". $this->db->escape($id) ."', username='". $this->db->escape($username) ."', type='TWITTER', date_added=NOW()");
	}

	public function addCustomerIdToTwitterUser($id, $customer_id) {
		$this->db->query("UPDATE ". DB_PREFIX ."mpsociallogin SET customer_id='". (int)$customer_id ."', date_modified=NOW() WHERE id='". $this->db->escape($id) ."' AND type='TWITTER'");
	}


	public function getCustomerByCustomerId($customer_id) {
		$query = $this->db->query("SELECT * FROM ". DB_PREFIX ."customer WHERE customer_id='". (int)$customer_id ."' ");
		return $query->row;
	}

	public function addCustomerInfoByCustomerId($customer_id, $data) {

		$implode = array();

		if(!empty($data['email'])) {
			$implode[] = "email='". $this->db->escape($data['email']) ."'";
		}
		
		if(!empty($data['firstname'])) {
			$implode[] = "firstname='". $this->db->escape($data['firstname']) ."'";
		}
		if(!empty($data['lastname'])) {
			$implode[] = "lastname='". $this->db->escape($data['lastname']) ."'";
		}
		if(!empty($data['telephone'])) {
			$implode[] = "telephone='". $this->db->escape($data['telephone']) ."'";
		}
		if(!empty($data['fax'])) {
			$implode[] = "fax='". $this->db->escape($data['fax']) ."'";
		}

		if($implode) {
			$sql = "UPDATE ". DB_PREFIX ."customer SET ";
			$sql .= implode(", ", $implode);
			$sql .= " WHERE customer_id='". (int)$customer_id ."'";

			$this->db->query($sql);
			return true;
		}
		return false;
	}
	/*new updates 28032018 ends*/
}