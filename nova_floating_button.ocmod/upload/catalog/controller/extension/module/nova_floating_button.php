<?php
class ControllerExtensionModuleNovaFloatingButton extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/nova_floating_button');
		
		$this->load->model('setting/setting');

		$data['module_nova_floating_button_status'] = $this->config->get('module_nova_floating_button_status');
		$data['module_nova_floating_button_link'] = $this->config->get('module_nova_floating_button_link');
		$data['module_nova_floating_button_image'] = $this->config->get('module_nova_floating_button_image');
		$data['module_nova_floating_button_width'] = $this->config->get('module_nova_floating_button_width');
		$data['module_nova_floating_button_height'] = $this->config->get('module_nova_floating_button_height');

		$this->load->model('tool/image');

		if (isset($data['module_nova_floating_button_image']) && is_file(DIR_IMAGE . $data['module_nova_floating_button_image'])) {
			$data['thumb'] = $this->model_tool_image->resize($data['module_nova_floating_button_image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		return $this->load->view('extension/module/nova_floating_button', $data);
	}
}
