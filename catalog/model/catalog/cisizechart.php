<?php
class ModelCatalogCiSizeChart extends Model {
	public function getCiSizeChart($cisizechart_id, $product_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "cisizechart s LEFT JOIN " . DB_PREFIX . "cisizechart_description sd ON (s.cisizechart_id = sd.cisizechart_id) LEFT JOIN " . DB_PREFIX . "cisizechart_product sp ON (s.cisizechart_id = sp.cisizechart_id) WHERE s.cisizechart_id = '" . (int)$cisizechart_id . "' AND sd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND sp.product_id = '" . (int)$product_id . "' AND s.status = '1'");

		return $query->row;
	}

	public function getCiSizeCharts($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "cisizechart s LEFT JOIN " . DB_PREFIX . "cisizechart_description sd ON (s.cisizechart_id = sd.cisizechart_id) LEFT JOIN " . DB_PREFIX . "cisizechart_product sp ON (s.cisizechart_id = sp.cisizechart_id) WHERE sd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND sp.product_id = '" . (int)$product_id . "' AND s.status = '1'");

		$sizechart_data = array();

		$this->load->model('tool/image');

		foreach ($query->rows as $value) {
			if ($value['icon']) {
				$icon = $this->model_tool_image->resize($value['icon'], 70, 70);
			} else {
				$icon = $this->model_tool_image->resize('no_image.png', 70, 70);
			}

			$sizechart_data[] = array(
				'cisizechart_id'		=> $value['cisizechart_id'],
				'icon'					=> $icon,
				'display_layout'		=> $value['display_layout'],
				'status'				=> $value['status'],
				'popup_type'			=> $value['popup_type'],
				'language_id'			=> $value['language_id'],
				'title'					=> $value['title'],
				'description'			=> html_entity_decode($value['description'], ENT_QUOTES, 'UTF-8'),
				'button'				=> $value['button'],
				'tab_text'				=> $value['tab_text'],
				'product_id'			=> $value['product_id'],
				'popup_href'			=> $this->url->link('product/cisizechart/popup', 'cisizechart_id='. $value['cisizechart_id'] .'&product_id='. $product_id, true),
			);
		}

		return $sizechart_data;
	}
}