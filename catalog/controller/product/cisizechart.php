<?php
class ControllerProductCisizechart extends Controller {
	public function popup() {
		$this->load->model('catalog/cisizechart');

		if (isset($this->request->get['cisizechart_id'])) {
			$cisizechart_id = (int)$this->request->get['cisizechart_id'];
		} else {
			$cisizechart_id = 0;
		}

		if (isset($this->request->get['product_id'])) {
			$product_id = (int)$this->request->get['product_id'];
		} else {
			$product_id = 0;
		}

		$json = array();

		$cisizechart_info = $this->model_catalog_cisizechart->getCiSizeChart($cisizechart_id, $product_id);

		if ($cisizechart_info) {
			$json['title'] = html_entity_decode($cisizechart_info['title'], ENT_QUOTES, 'UTF-8') . "\n";
			
			$json['description'] = html_entity_decode($cisizechart_info['description'], ENT_QUOTES, 'UTF-8') . "\n";
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
