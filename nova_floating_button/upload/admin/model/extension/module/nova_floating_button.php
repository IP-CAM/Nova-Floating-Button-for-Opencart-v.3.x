<?php
class ModelExtensionModuleNovaFloatingButton extends Model {
	public function install() {
		
	}

	public function uninstall() {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'module_nova_floating_button';");
	}
}
