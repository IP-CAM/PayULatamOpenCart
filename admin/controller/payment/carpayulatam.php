<?php
class ControllerPaymentCarPayULatam extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('payment/carpayulatam');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->load->model('setting/setting');
			
			$this->model_setting_setting->editSetting('carpayulatam', $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect(HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token']);
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		

		$this->data['entry_merchantId'] = $this->language->get('entry_merchantId');
		$this->data['entry_apiKey'] = $this->language->get('entry_apiKey');
		$this->data['entry_apiLogin'] = $this->language->get('entry_apiLogin');
		$this->data['entry_publicKey'] = $this->language->get('entry_publicKey');
                $this->data['entry_accountId'] = $this->language->get('entry_accountId');
		
		$this->data['entry_url_pasarela'] = $this->language->get('entry_url_pasarela');
		$this->data['entry_prueba'] = $this->language->get('entry_prueba');	
		
        
		$this->data['entry_order_status'] = $this->language->get('entry_order_status');	
		
		
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		$this->data['tab_general'] = $this->language->get('tab_general');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->error['merchantId'])) {
			$this->data['error_umerchantId'] = $this->error['merchantId'];
		} else {
			$this->data['error_merchantId'] = '';
		}
                
                
		if (isset($this->error['apiKey'])) {
			$this->data['error_apiKey'] = $this->error['apiKey'];
		} else {
			$this->data['error_apiKey'] = '';
		}
		
                if (isset($this->error['apiLogin'])) {
			$this->data['error_apiLogin'] = $this->error['apiLogin'];
		} else {
			$this->data['error_apiLogin'] = '';
		}
		
                if (isset($this->error['publicKey'])) {
			$this->data['error_publicKey'] = $this->error['publicKey'];
		} else {
			$this->data['error_publicKey'] = '';
		}
                if (isset($this->error['accountId'])) {
			$this->data['error_accountId'] = $this->error['accountId'];
		} else {
			$this->data['error_accountId'] = '';
		}
                
		if (isset($this->error['url_pasarela'])) {
			$this->data['error_url_pasarela'] = $this->error['url_pasarela'];
		} else {
			$this->data['error_url_pasarela'] = '';
		}
		

		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),       		
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/carpayulatam', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
		$this->data['action'] = HTTPS_SERVER . 'index.php?route=payment/carpayulatam&token=' . $this->session->data['token'];
		
		$this->data['cancel'] = HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token'];
		
		if (isset($this->request->post['carpayulatam_descripcion'])) {
			$this->data['carpayulatam_descripcion'] = $this->request->post['carpayulatam_descripcion'];
		} else {
			$this->data['carpayulatam_descripcion'] = $this->config->get('carpayulatam_descripcion');
		}
		
		if (isset($this->request->post['carpayulatam_merchantId'])) {
			$this->data['carpayulatam_merchantId'] = $this->request->post['carpayulatam_merchantId'];
		} else {
			$this->data['carpayulatam_merchantId'] = $this->config->get('carpayulatam_merchantId');
		}

		if (isset($this->request->post['carpayulatam_apiKey'])) {
			$this->data['carpayulatam_apiKey'] = $this->request->post['carpayulatam_apiKey'];
		} else {
			$this->data['carpayulatam_apiKey'] = $this->config->get('carpayulatam_apiKey');
		}
		if (isset($this->request->post['carpayulatam_apiLogin'])) {
			$this->data['carpayulatam_apiLogin'] = $this->request->post['carpayulatam_apiLogin'];
		} else {
			$this->data['carpayulatam_apiLogin'] = $this->config->get('carpayulatam_apiLogin');
		}
		if (isset($this->request->post['carpayulatam_publicKey'])) {
			$this->data['carpayulatam_publicKey'] = $this->request->post['carpayulatam_publicKey'];
		} else {
			$this->data['carpayulatam_publicKey'] = $this->config->get('carpayulatam_publicKey');
		}
		if (isset($this->request->post['carpayulatam_accountId'])) {
			$this->data['carpayulatam_accountId'] = $this->request->post['carpayulatam_accountId'];
		} else {
			$this->data['carpayulatam_accountId'] = $this->config->get('carpayulatam_accountId');
		}
		
		
		if (isset($this->request->post['carpayulatam_prueba'])) {
			$this->data['carpayulatam_prueba'] = $this->request->post['carpayulatam_prueba'];
		} else {
			$this->data['carpayulatam_prueba'] = $this->config->get('carpayulatam_prueba');
		}
		
	
		


		if (isset($this->request->post['carpayulatam_order_status_id'])) {
			$this->data['carpayulatam_order_status_id'] = $this->request->post['carpayulatam_order_status_id'];
		} else {
			$this->data['carpayulatam_order_status_id'] = $this->config->get('carpayulatam_order_status_id');
		}

		$this->load->model('localisation/order_status');
		
		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		if (isset($this->request->post['carpayulatam_status'])) {
			$this->data['carpayulatam_status'] = $this->request->post['carpayulatam_status'];
		} else {
			$this->data['carpayulatam_status'] = $this->config->get('carpayulatam_status');
		}

		if (isset($this->request->post['carpayulatam_sort_order'])) {
			$this->data['carpayulatam_sort_order'] = $this->request->post['carpayulatam_sort_order'];
		} else {
			$this->data['carpayulatam_sort_order'] = $this->config->get('carpayulatam_sort_order');
		}

		$this->template = 'payment/carpayulatam.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/carpayulatam')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if (!$this->request->post['carpayulatam_merchantId']) {
			$this->error['merchantId'] = $this->language->get('error_merchantId');
		}

		if (!$this->request->post['carpayulatam_apiKey']) {
			$this->error['apiKey'] = $this->language->get('error_apiKey');
		}
		if (!$this->request->post['carpayulatam_publicKey']) {
			$this->error['publicKey'] = $this->language->get('error_publicKey');
		}
		if (!$this->request->post['carpayulatam_accountId']) {
			$this->error['accountId'] = $this->language->get('error_accountId');
		}
		if (!$this->request->post['carpayulatam_apiLogin']) {
			$this->error['apiLogin'] = $this->language->get('error_apiLogin');
		}
		
		

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
}
?>