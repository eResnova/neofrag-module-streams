<?php if (!defined('NEOFRAG_CMS')) exit;
/**************************************************************************
Copyright © 2015 Michaël BILCOT & Jérémy VALENTIN

This file is part of NeoFrag.

NeoFrag is free software: you can redistribute it and/or modify
it under the terms of the GNU Lesser General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

NeoFrag is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public License
along with NeoFrag. If not, see <http://www.gnu.org/licenses/>.
**************************************************************************/

class m_streams extends Module
{
	public $title       = 'Streams';
	public $description = '';
	public $icon        = 'fa-video-camera';
	public $link        = 'http://www.neofrag.com';
	public $author      = 'Michaël Bilcot <michael.bilcot@neofrag.com>';
	public $licence     = 'http://www.neofrag.com/license.html LGPLv3';
	public $version     = 'Alpha 1.0.0';
	public $nf_version  = 'Alpha 0.1.6.1';
	public $path        = __FILE__;
	public $admin       = 'gaming';
	public $routes      = [
		//Index
		'{id}/{url_title}'                           => '_stream',
		//Admin
		'admin/{id}/{url_title*}'                    => '_edit'
	];

	public static function permissions()
	{
		return [
			'default' => [
				'access'  => [
					[
						'title'  => 'Streams',
						'icon'   => 'file-text-o',
						'access' => [
							'add_streams' => [
								'title' => 'Ajouter',
								'icon'  => 'fa-plus',
								'admin' => TRUE
							],
							'modify_streams' => [
								'title' => 'Modifier',
								'icon'  => 'fa-edit',
								'admin' => TRUE
							],
							'delete_streams' => [
								'title' => 'Supprimer',
								'icon'  => 'fa-trash-o',
								'admin' => TRUE
							]
						]
					]
				]
			]
		];
	}

	public function settings()
	{
		$this	->form
				->add_rules([
					'streams_per_row' => [
						'label' => 'Affichage par ligne',
						'value' => $this->config->streams_per_row,
						'values' => [
							'12' => '1',
							'6'  => '2',
							'4'  => '3',
							'3'  => '4',
							'2'  => '6'
						],
						'type'  => 'select',
						'rules' => 'required',
						'size'  => 'col-md-2'
					]
				])
				->add_submit($this->lang('edit'))
				->add_back('admin/addons#modules');

		if ($this->form->is_valid($post))
		{
			$this->config('streams_per_row', $post['streams_per_row']);
			
			redirect_back('admin/addons#modules');
		}

		return $this->panel()->body($this->form->display());
	}

	public function install()
	{
		$this->config('streams_per_row', '4', INT);

		$this->db	->execute('CREATE TABLE `nf_streams` (
						`stream_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
						`title` varchar(255) NOT NULL,
						`url` varchar(255) NOT NULL,
						`id` varchar(255) NOT NULL,
						`provider` varchar(255) NOT NULL,
						PRIMARY KEY (`stream_id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;');

		return parent::install();
	}
}

/*
NeoFrag Alpha 0.1.6.1
./modules/streams/streams.php
*/