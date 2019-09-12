<?php
class ModelCatalogCiSizeChart extends Model {
	public function addCiSizeChart($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "cisizechart SET status = '" . (int)$data['status'] . "', icon = '" . $this->db->escape($data['icon']) . "', display_layout = '" . $this->db->escape($data['display_layout']) . "', popup_type = '" . $this->db->escape($data['popup_type']) . "'");

		$cisizechart_id = $this->db->getLastId();

		foreach ($data['cisizechart_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "cisizechart_description SET cisizechart_id = '" . (int)$cisizechart_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', button = '" . $this->db->escape($value['button']) . "', tab_text = '" . $this->db->escape($value['tab_text']) . "'");
		}

		if (isset($data['cisizechart_product'])) {
			foreach ($data['cisizechart_product'] as $product_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "cisizechart_product SET product_id = '" . (int)$product_id . "', cisizechart_id = '" . (int)$cisizechart_id . "'");
			}
		}

		return $cisizechart_id;
	}

	public function editCiSizeChart($cisizechart_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "cisizechart SET status = '" . (int)$data['status'] . "', icon = '" . $this->db->escape($data['icon']) . "', display_layout = '" . $this->db->escape($data['display_layout']) . "', popup_type = '" . $this->db->escape($data['popup_type']) . "' WHERE cisizechart_id = '" . (int)$cisizechart_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "cisizechart_description WHERE cisizechart_id = '" . (int)$cisizechart_id . "'");

		foreach ($data['cisizechart_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "cisizechart_description SET cisizechart_id = '" . (int)$cisizechart_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', button = '" . $this->db->escape($value['button']) . "', tab_text = '" . $this->db->escape($value['tab_text']) . "' ");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "cisizechart_product WHERE cisizechart_id = '" . (int)$cisizechart_id . "'");

		if (isset($data['cisizechart_product'])) {
			foreach ($data['cisizechart_product'] as $product_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "cisizechart_product SET product_id = '" . (int)$product_id . "', cisizechart_id = '" . (int)$cisizechart_id . "'");
			}
		}
	}

	public function deleteCiSizeChart($cisizechart_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "cisizechart WHERE cisizechart_id = '" . (int)$cisizechart_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "cisizechart_description WHERE cisizechart_id = '" . (int)$cisizechart_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "cisizechart_product WHERE cisizechart_id = '" . (int)$cisizechart_id . "'");
	}

	public function getCiSizeChart($cisizechart_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "cisizechart WHERE cisizechart_id = '" . (int)$cisizechart_id . "'");

		return $query->row;
	}

	public function getCiSizeCharts($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "cisizechart i LEFT JOIN " . DB_PREFIX . "cisizechart_description id ON (i.cisizechart_id = id.cisizechart_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		$sort_data = array(
			'id.title',
			'i.status'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY id.title";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getCiSizeChartDescriptions($cisizechart_id) {
		$cisizechart_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "cisizechart_description WHERE cisizechart_id = '" . (int)$cisizechart_id . "'");

		foreach ($query->rows as $result) {
			$cisizechart_description_data[$result['language_id']] = array(
				'title'            => $result['title'],
				'description'      => $result['description'],
				'button'      	   => $result['button'],
				'tab_text'      	   => $result['tab_text'],
			);
		}

		return $cisizechart_description_data;
	}

	public function getCiSizeChartProducts($cisizechart_id) {
		$sizechart_product_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "cisizechart_product WHERE cisizechart_id = '" . (int)$cisizechart_id . "'");

		foreach ($query->rows as $result) {
			$sizechart_product_data[] = $result['product_id'];
		}

		return $sizechart_product_data;
	}

	public function getTotalCiSizeCharts() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "cisizechart");

		return $query->row['total'];
	}

	public function Buildtable() {
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "cisizechart` (`cisizechart_id` int(11) NOT NULL AUTO_INCREMENT,`icon` varchar(255) NOT NULL,`display_layout` varchar(255) NOT NULL,`status` int(11) NOT NULL,`popup_type` varchar(255) NOT NULL,PRIMARY KEY (`cisizechart_id`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0");

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "cisizechart_description` (`cisizechart_id` int(11) NOT NULL,`language_id` int(11) NOT NULL,`title` varchar(255) NOT NULL,`description` longtext NOT NULL,`button` varchar(255) NOT NULL,`tab_text` varchar(255) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8");

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "cisizechart_product` (`cisizechart_id` int(11) NOT NULL,`product_id` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8");
	}
}