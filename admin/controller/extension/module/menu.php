<?php
class ControllerExtensionModuleMenu extends Controller
{
    private $error = array();

    public function index() {
        $this->load->language('extension/module/menu');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/module');
        $this->load->model('design/menu');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            if (!isset($this->request->get['module_id'])) {
                $this->model_setting_module->addModule('menu', $this->request->post);
            } else {
                $this->model_setting_module->editModule($this->request->get['module_id'], $this->request->post);
            }

            $this->cache->delete('product');

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
        }

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['name'])) {
            $data['error_name'] = $this->error['name'];
        } else {
            $data['error_name'] = '';
        }

        $data['menus'] = array();
        $menuList = $this->model_design_menu->getMenuList();
        foreach ($menuList as $menu) {
            $data['menus'][] = array(
                'id'    => $menu['menu_id'],
                'name'  => $menu['name']
            );
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

        if (!isset($this->request->get['module_id'])) {
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('extension/module/menu', 'user_token=' . $this->session->data['user_token'], true)
            );
        } else {
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('extension/module/menu', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true)
            );
        }

        if (!isset($this->request->get['module_id'])) {
            $data['action'] = $this->url->link('extension/module/menu', 'user_token=' . $this->session->data['user_token'], true);
        } else {
            $data['action'] = $this->url->link('extension/module/menu', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true);
        }

        $data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

        if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $module_info = $this->model_setting_module->getModule($this->request->get['module_id']);
        }

        // General Settings
        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($module_info)) {
            $data['status'] = $module_info['status'];
        } else {
            $data['status'] = '';
        }

        if (isset($this->request->post['menu'])) {
            $data['menu'] = $this->request->post['menu'];
        } elseif (!empty($module_info)) {
            $data['menu'] = $module_info['menu'];
        } else {
            $data['menu'] = '';
        }

        if (isset($this->request->post['name'])) {
            $data['name'] = $this->request->post['name'];
        } elseif (!empty($module_info)) {
            $data['name'] = $module_info['name'];
        } else {
            $data['name'] = '';
        }

        if (isset($this->request->post['effect'])) {
            $data['effect'] = $this->request->post['effect'];
        } elseif (!empty($module_info)) {
            $data['effect'] = $module_info['effect'];
        } else {
            $data['effect'] = 'none';
        }

        // Menu Bar
        if (isset($this->request->post['menu_height'])) {
            $data['menu_height'] = $this->request->post['menu_height'];
        } elseif (!empty($module_info)) {
            $data['menu_height'] = $module_info['menu_height'];
        } else {
            $data['menu_height'] = '40px';
        }

        if (isset($this->request->post['menu_bg'])) {
            $data['menu_bg'] = $this->request->post['menu_bg'];
        } elseif (!empty($module_info)) {
            $data['menu_bg'] = $module_info['menu_bg'];
        } else {
            $data['menu_bg'] = '';
        }

        if (isset($this->request->post['menu_text_color'])) {
            $data['menu_text_color'] = $this->request->post['menu_text_color'];
        } elseif (!empty($module_info)) {
            $data['menu_text_color'] = $module_info['menu_text_color'];
        } else {
            $data['menu_text_color'] = '';
        }

        if (isset($this->request->post['menu_pd_top'])) {
            $data['menu_pd_top'] = $this->request->post['menu_pd_top'];
        } elseif (!empty($module_info)) {
            $data['menu_pd_top'] = $module_info['menu_pd_top'];
        } else {
            $data['menu_pd_top'] = '0px';
        }

        if (isset($this->request->post['menu_pd_right'])) {
            $data['menu_pd_right'] = $this->request->post['menu_pd_right'];
        } elseif (!empty($module_info)) {
            $data['menu_pd_right'] = $module_info['menu_pd_right'];
        } else {
            $data['menu_pd_right'] = '0px';
        }

        if (isset($this->request->post['menu_pd_bottom'])) {
            $data['menu_pd_bottom'] = $this->request->post['menu_pd_bottom'];
        } elseif (!empty($module_info)) {
            $data['menu_pd_bottom'] = $module_info['menu_pd_bottom'];
        } else {
            $data['menu_pd_bottom'] = '0px';
        }

        if (isset($this->request->post['menu_pd_left'])) {
            $data['menu_pd_left'] = $this->request->post['menu_pd_left'];
        } elseif (!empty($module_info)) {
            $data['menu_pd_left'] = $module_info['menu_pd_left'];
        } else {
            $data['menu_pd_left'] = '0px';
        }

        // Top Level Items
        if (isset($this->request->post['item_bg'])) {
            $data['item_bg'] = $this->request->post['item_bg'];
        } elseif (!empty($module_info)) {
            $data['item_bg'] = $module_info['item_bg'];
        } else {
            $data['item_bg'] = '';
        }

        if (isset($this->request->post['item_bg_hover'])) {
            $data['item_bg_hover'] = $this->request->post['item_bg_hover'];
        } elseif (!empty($module_info)) {
            $data['item_bg_hover'] = $module_info['item_bg_hover'];
        } else {
            $data['item_bg_hover'] = '';
        }

        if (isset($this->request->post['item_font_color'])) {
            $data['item_font_color'] = $this->request->post['item_font_color'];
        } elseif (!empty($module_info)) {
            $data['item_font_color'] = $module_info['item_font_color'];
        } else {
            $data['item_font_color'] = '';
        }

        if (isset($this->request->post['item_font_size'])) {
            $data['item_font_size'] = $this->request->post['item_font_size'];
        } elseif (!empty($module_info)) {
            $data['item_font_size'] = $module_info['item_font_size'];
        } else {
            $data['item_font_size'] = '14px';
        }
		
		if (isset($this->request->post['item_line_height'])) {
            $data['item_line_height'] = $this->request->post['item_line_height'];
        } elseif (!empty($module_info)) {
            $data['item_line_height'] = $module_info['item_line_height'];
        } else {
            $data['item_line_height'] = '24px';
        }
		
        if (isset($this->request->post['item_font_transform'])) {
            $data['item_font_transform'] = $this->request->post['item_font_transform'];
        } elseif (!empty($module_info)) {
            $data['item_font_transform'] = $module_info['item_font_transform'];
        } else {
            $data['item_font_transform'] = 'none';
        }

        if (isset($this->request->post['item_font_weight'])) {
            $data['item_font_weight'] = $this->request->post['item_font_weight'];
        } elseif (!empty($module_info)) {
            $data['item_font_weight'] = $module_info['item_font_weight'];
        } else {
            $data['item_font_weight'] = '400';
        }

        if (isset($this->request->post['item_font_color_hover'])) {
            $data['item_font_color_hover'] = $this->request->post['item_font_color_hover'];
        } elseif (!empty($module_info)) {
            $data['item_font_color_hover'] = $module_info['item_font_color_hover'];
        } else {
            $data['item_font_color_hover'] = '';
        }

        if (isset($this->request->post['item_font_weight_hover'])) {
            $data['item_font_weight_hover'] = $this->request->post['item_font_weight_hover'];
        } elseif (!empty($module_info)) {
            $data['item_font_weight_hover'] = $module_info['item_font_weight_hover'];
        } else {
            $data['item_font_weight_hover'] = '400';
        }
		
		if (isset($this->request->post['item_pd_top'])) {
            $data['item_pd_top'] = $this->request->post['item_pd_top'];
        } elseif (!empty($module_info)) {
            $data['item_pd_top'] = $module_info['item_pd_top'];
        } else {
            $data['item_pd_top'] = '0px';
        }

        if (isset($this->request->post['item_pd_right'])) {
            $data['item_pd_right'] = $this->request->post['item_pd_right'];
        } elseif (!empty($module_info)) {
            $data['item_pd_right'] = $module_info['item_pd_right'];
        } else {
            $data['item_pd_right'] = '0px';
        }

        if (isset($this->request->post['item_pd_bottom'])) {
            $data['item_pd_bottom'] = $this->request->post['item_pd_bottom'];
        } elseif (!empty($module_info)) {
            $data['item_pd_bottom'] = $module_info['item_pd_bottom'];
        } else {
            $data['item_pd_bottom'] = '0px';
        }

        if (isset($this->request->post['item_pd_left'])) {
            $data['item_pd_left'] = $this->request->post['item_pd_left'];
        } elseif (!empty($module_info)) {
            $data['item_pd_left'] = $module_info['item_pd_left'];
        } else {
            $data['item_pd_left'] = '0px';
        }
		
        if (isset($this->request->post['item_show'])) {
            $data['item_show'] = $this->request->post['item_show'];
        } elseif (!empty($module_info)) {
            $data['item_show'] = $module_info['item_show'];
        } else {
            $data['item_show'] = 5;
        }

        // Mega Menu Settings
        if (isset($this->request->post['mega_menu_bg'])) {
            $data['mega_menu_bg'] = $this->request->post['mega_menu_bg'];
        } elseif (!empty($module_info)) {
            $data['mega_menu_bg'] = $module_info['mega_menu_bg'];
        } else {
            $data['mega_menu_bg'] = '';
        }

        if (isset($this->request->post['mega_second_link_color'])) {
            $data['mega_second_link_color'] = $this->request->post['mega_second_link_color'];
        } elseif (!empty($module_info)) {
            $data['mega_second_link_color'] = $module_info['mega_second_link_color'];
        } else {
            $data['mega_second_link_color'] = '';
        }
		
		if (isset($this->request->post['mega_third_link_color'])) {
            $data['mega_third_link_color'] = $this->request->post['mega_third_link_color'];
        } elseif (!empty($module_info)) {
            $data['mega_third_link_color'] = $module_info['mega_third_link_color'];
        } else {
            $data['mega_third_link_color'] = '';
        }

        if (isset($this->request->post['mega_menu_width'])) {
            $data['mega_menu_width'] = $this->request->post['mega_menu_width'];
        } elseif (!empty($module_info)) {
            $data['mega_menu_width'] = $module_info['mega_menu_width'];
        } else {
            $data['mega_menu_width'] = '100%';
        }

        if (isset($this->request->post['mega_menu_pd_top'])) {
            $data['mega_menu_pd_top'] = $this->request->post['mega_menu_pd_top'];
        } elseif (!empty($module_info)) {
            $data['mega_menu_pd_top'] = $module_info['mega_menu_pd_top'];
        } else {
            $data['mega_menu_pd_top'] = '0px';
        }

        if (isset($this->request->post['mega_menu_pd_right'])) {
            $data['mega_menu_pd_right'] = $this->request->post['mega_menu_pd_right'];
        } elseif (!empty($module_info)) {
            $data['mega_menu_pd_right'] = $module_info['mega_menu_pd_right'];
        } else {
            $data['mega_menu_pd_right'] = '0px';
        }

        if (isset($this->request->post['mega_menu_pd_bottom'])) {
            $data['mega_menu_pd_bottom'] = $this->request->post['mega_menu_pd_bottom'];
        } elseif (!empty($module_info)) {
            $data['mega_menu_pd_bottom'] = $module_info['mega_menu_pd_bottom'];
        } else {
            $data['mega_menu_pd_bottom'] = '0px';
        }

        if (isset($this->request->post['mega_menu_pd_left'])) {
            $data['mega_menu_pd_left'] = $this->request->post['mega_menu_pd_left'];
        } elseif (!empty($module_info)) {
            $data['mega_menu_pd_left'] = $module_info['mega_menu_pd_left'];
        } else {
            $data['mega_menu_pd_left'] = '0px';
        }
		
        // Flyout Menu Settings
        // Second Level Items
        if (isset($this->request->post['second_item_bg'])) {
            $data['second_item_bg'] = $this->request->post['second_item_bg'];
        } elseif (!empty($module_info)) {
            $data['second_item_bg'] = $module_info['second_item_bg'];
        } else {
            $data['second_item_bg'] = '';
        }

        if (isset($this->request->post['second_item_bg_hover'])) {
            $data['second_item_bg_hover'] = $this->request->post['second_item_bg_hover'];
        } elseif (!empty($module_info)) {
            $data['second_item_bg_hover'] = $module_info['second_item_bg_hover'];
        } else {
            $data['second_item_bg_hover'] = '';
        }

        if (isset($this->request->post['second_item_font_color'])) {
            $data['second_item_font_color'] = $this->request->post['second_item_font_color'];
        } elseif (!empty($module_info)) {
            $data['second_item_font_color'] = $module_info['second_item_font_color'];
        } else {
            $data['second_item_font_color'] = '';
        }

        if (isset($this->request->post['second_item_font_size'])) {
            $data['second_item_font_size'] = $this->request->post['second_item_font_size'];
        } elseif (!empty($module_info)) {
            $data['second_item_font_size'] = $module_info['second_item_font_size'];
        } else {
            $data['second_item_font_size'] = '12px';
        }

        if (isset($this->request->post['second_item_font_transform'])) {
            $data['second_item_font_transform'] = $this->request->post['second_item_font_transform'];
        } elseif (!empty($module_info)) {
            $data['second_item_font_transform'] = $module_info['second_item_font_transform'];
        } else {
            $data['second_item_font_transform'] = 'none';
        }

        if (isset($this->request->post['second_item_font_weight'])) {
            $data['second_item_font_weight'] = $this->request->post['second_item_font_weight'];
        } elseif (!empty($module_info)) {
            $data['second_item_font_weight'] = $module_info['second_item_font_weight'];
        } else {
            $data['second_item_font_weight'] = '400';
        }

        if (isset($this->request->post['second_item_font_color_hover'])) {
            $data['second_item_font_color_hover'] = $this->request->post['second_item_font_color_hover'];
        } elseif (!empty($module_info)) {
            $data['second_item_font_color_hover'] = $module_info['second_item_font_color_hover'];
        } else {
            $data['second_item_font_color_hover'] = '';
        }

        if (isset($this->request->post['second_item_font_weight_hover'])) {
            $data['second_item_font_weight_hover'] = $this->request->post['second_item_font_weight_hover'];
        } elseif (!empty($module_info)) {
            $data['second_item_font_weight_hover'] = $module_info['second_item_font_weight_hover'];
        } else {
            $data['second_item_font_weight_hover'] = '400';
        }

        // Third Level Items
        if (isset($this->request->post['third_item_bg'])) {
            $data['third_item_bg'] = $this->request->post['third_item_bg'];
        } elseif (!empty($module_info)) {
            $data['third_item_bg'] = $module_info['third_item_bg'];
        } else {
            $data['third_item_bg'] = '';
        }

        if (isset($this->request->post['third_item_bg_hover'])) {
            $data['third_item_bg_hover'] = $this->request->post['third_item_bg_hover'];
        } elseif (!empty($module_info)) {
            $data['third_item_bg_hover'] = $module_info['third_item_bg_hover'];
        } else {
            $data['third_item_bg_hover'] = '';
        }

        if (isset($this->request->post['third_item_font_color'])) {
            $data['third_item_font_color'] = $this->request->post['third_item_font_color'];
        } elseif (!empty($module_info)) {
            $data['third_item_font_color'] = $module_info['third_item_font_color'];
        } else {
            $data['third_item_font_color'] = '';
        }

        if (isset($this->request->post['third_item_font_size'])) {
            $data['third_item_font_size'] = $this->request->post['third_item_font_size'];
        } elseif (!empty($module_info)) {
            $data['third_item_font_size'] = $module_info['third_item_font_size'];
        } else {
            $data['third_item_font_size'] = '11px';
        }

        if (isset($this->request->post['third_item_font_transform'])) {
            $data['third_item_font_transform'] = $this->request->post['third_item_font_transform'];
        } elseif (!empty($module_info)) {
            $data['third_item_font_transform'] = $module_info['third_item_font_transform'];
        } else {
            $data['third_item_font_transform'] = 'none';
        }

        if (isset($this->request->post['third_item_font_weight'])) {
            $data['third_item_font_weight'] = $this->request->post['third_item_font_weight'];
        } elseif (!empty($module_info)) {
            $data['third_item_font_weight'] = $module_info['third_item_font_weight'];
        } else {
            $data['third_item_font_weight'] = '400';
        }

        if (isset($this->request->post['third_item_font_color_hover'])) {
            $data['third_item_font_color_hover'] = $this->request->post['third_item_font_color_hover'];
        } elseif (!empty($module_info)) {
            $data['third_item_font_color_hover'] = $module_info['third_item_font_color_hover'];
        } else {
            $data['third_item_font_color_hover'] = '';
        }

        if (isset($this->request->post['third_item_font_weight_hover'])) {
            $data['third_item_font_weight_hover'] = $this->request->post['third_item_font_weight_hover'];
        } elseif (!empty($module_info)) {
            $data['third_item_font_weight_hover'] = $module_info['third_item_font_weight_hover'];
        } else {
            $data['third_item_font_weight_hover'] = '400';
        }

        $this->document->addScript('view/javascript/menu/jscolor.js');
        $this->document->addStyle('view/stylesheet/menu/menu.css');

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/menu', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/menu')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
            $this->error['name'] = $this->language->get('error_name');
        }

        return !$this->error;
    }

    
}