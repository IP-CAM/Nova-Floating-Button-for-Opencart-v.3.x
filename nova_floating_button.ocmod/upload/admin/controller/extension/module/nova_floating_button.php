<?php
class ControllerExtensionModuleNovaFloatingButton extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/nova_floating_button');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('module_nova_floating_button', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['link'])) {
			$data['error_link'] = $this->error['link'];
		} else {
			$data['error_link'] = '';
		}

		if (isset($this->error['image'])) {
			$data['error_image'] = $this->error['image'];
		} else {
			$data['error_image'] = '';
		}

		if (isset($this->error['width'])) {
			$data['error_width'] = $this->error['width'];
		} else {
			$data['error_width'] = '';
		}

		if (isset($this->error['height'])) {
			$data['error_height'] = $this->error['height'];
		} else {
			$data['error_height'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/nova_floating_button', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/module/nova_floating_button', 'user_token=' . $this->session->data['user_token'], true);

		
		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		if (isset($this->request->post['module_nova_floating_button_link'])) {
			$data['module_nova_floating_button_link'] = $this->request->post['module_nova_floating_button_link'];
		} else {
			$data['module_nova_floating_button_link'] = $this->config->get('module_nova_floating_button_link');
		}

		if (isset($this->request->post['module_nova_floating_button_image'])) {
			$data['module_nova_floating_button_image'] = $this->request->post['module_nova_floating_button_image'];
		} else {
			$data['module_nova_floating_button_image'] = $this->config->get('module_nova_floating_button_image');
		}

		if (isset($this->request->post['module_nova_floating_button_width'])) {
			$data['module_nova_floating_button_width'] = $this->request->post['module_nova_floating_button_width'];
		} else {
			$data['module_nova_floating_button_width'] = $this->config->get('module_nova_floating_button_width');
		}

		if (isset($this->request->post['module_nova_floating_button_height'])) {
			$data['module_nova_floating_button_height'] = $this->request->post['module_nova_floating_button_height'];
		} else {
			$data['module_nova_floating_button_height'] = $this->config->get('module_nova_floating_button_height');
		}

		if (isset($this->request->post['module_nova_floating_button_status'])) {
			$data['module_nova_floating_button_status'] = $this->request->post['module_nova_floating_button_status'];
		} else {
			$data['module_nova_floating_button_status'] = $this->config->get('module_nova_floating_button_status');
		}

		$this->load->model('tool/image');

		if (isset($data['module_nova_floating_button_image']) && is_file(DIR_IMAGE . $data['module_nova_floating_button_image'])) {
			$data['thumb'] = $this->model_tool_image->resize($data['module_nova_floating_button_image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/nova_floating_button', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/nova_floating_button')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['module_nova_floating_button_link']) < 3) || (utf8_strlen($this->request->post['module_nova_floating_button_link']) > 64)) {
			$this->error['link'] = $this->language->get('error_link');
		}

		if (!$this->request->post['module_nova_floating_button_width']) {
			$this->error['width'] = $this->language->get('error_width');
		}

		if (!$this->request->post['module_nova_floating_button_height']) {
			$this->error['height'] = $this->language->get('error_height');
		}

		return !$this->error;
	}

	public function install() {
		$this->load->model('extension/module/nova_floating_button');

		$this->model_extension_module_nova_floating_button->install();
	}

	public function uninstall() {
		$this->load->model('extension/module/nova_floating_button');

		$this->model_extension_module_nova_floating_button->uninstall();
	}

}
