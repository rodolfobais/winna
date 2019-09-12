<?php

/**
 * @property Loader $load
 * @property Log $log
 * @property Request $request
 * @property Response $response
 * @property ModelToolIP2LocationRedirector model_tool_ip2location_redirector
 */
class ControllerStartupIP2LocationRedirector extends Controller
{

	/**
	 * @return void
	 */
	public function index()
	{
		try {
			$this->load->model('tool/ip2location_redirector');
		} catch (Exception $e) {
			$this->log->write($e->getMessage());
			return;
		}

		if (!$this->isActive())
			return;

		if ($this->request->server["SERVER_NAME"] !== 'www.tulocalonline.com')
			return;

		if ($rule = $this->model_tool_ip2location_redirector->getRule($this->request->server['REQUEST_URI'])) {
			if ($rule['code'] == 404) {
				$this->request->get['route'] = 'error/not_found';
			} else {
				$this->response->redirect($rule['to'], $rule['code']);
			}
		}
	}

	/**
	 * @return boolean
	 */
	protected function isActive()
	{
		return $this->model_tool_ip2location_redirector->isModuleEnabled();
	}
}
