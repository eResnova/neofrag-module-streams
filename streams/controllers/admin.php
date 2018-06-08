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

class m_streams_c_admin extends Controller_Module
{
	public function index()
	{
		$streams = $this->table
						->add_columns([
							[
								'title'   => 'ID',
								'content' => function($data){
									return $data['id'];
								},
								'search' => function($data){
									return $data['id'];
								},
								'sort' => function($data){
									return $data['id'];
								}
							],
							[
								'title'   => 'Titre',
								'content' => function($data){
									return '<a href="'.url('streams/'.$data['stream_id'].'/'.url_title($data['title'])).'">'.$data['title'].'</a>';
								},
								'search' => function($data){
									return $data['title'];
								},
								'sort' => function($data){
									return $data['title'];
								}
							],
							[
								'title'   => 'URL',
								'content' => function($data){
									return '<a href="'.url('streams/'.$data['stream_id'].'/'.url_title($data['title'])).'">'.$data['url'].'</a>';
								},
								'search' => function($data){
									return $data['url'];
								},
								'sort' => function($data){
									return $data['url'];
								}
							],
							[
								'title'   => 'Plateforme',
								'content' => function($data){
									return $data['provider'];
								},
								'search' => function($data){
									return $data['provider'];
								},
								'sort' => function($data){
									return $data['provider'];
								}
							],
							[
								'content' => [
									function($data){
										return $this->is_authorized('modify_streams') ? $this->button_update('admin/streams/'.$data['stream_id'].'/'.url_title($data['title'])) : NULL;
									},
									function($data){
										return $this->is_authorized('delete_streams') ? $this->button_delete('admin/streams/delete/'.$data['stream_id'].'/'.url_title($data['title'])) : NULL;
									}
								],
								'size'    => TRUE
							]
						])
						->data($this->model()->get_streams())
						->no_data('Il n\'y a aucun streamer')
						->display();

		return $this->row(
			$this->col(
				$this	->panel()
						->heading('Liste des streamers', 'fa-video-camera')
						->body($streams)
						->footer($this->is_authorized('add_streams') ? $this->button_create('admin/streams/add', 'Ajouter un streamer') : NULL)
						->size('col-lg-12')
			)
		);
	}

	public function add()
	{
		$this	->subtitle('Ajouter un streamer')
				->form
				->add_rules('stream')
				->add_submit($this->lang('add'))
				->add_back('admin/streams');

		if ($this->form->is_valid($post))
		{
			$this->model()->add_stream(	$post['title'],
										$post['url'],
										$post['id'],
										$post['provider']);

			notify('Streamer ajouté avec succès !s');

			redirect('admin/streams');
		}

		return $this->panel()
					->heading('Nouveau streamer', 'fa-video-camera')
					->body($this->form->display());
	}

	public function _edit($stream_id, $title, $url, $id, $provider)
	{
		$form_stream = $this->subtitle($title)
							->form
							->add_rules('stream', [
								'title'    => $title,
								'url'      => $url,
								'id'       => $id,
								'provider' => $provider
							])
							->add_submit($this->lang('edit'))
							->add_back('admin/streams')
							->save();

		if ($form_stream->is_valid($post))
		{
			$this->model()->edit_stream($stream_id,
										$post['title'],
										$post['url'],
										$post['id'],
										$post['provider']);

			notify('Stream édité avec succès !');

			redirect_back('admin/streams');
		}

		return $this->row(
			$this->col(
				$this	->panel()
						->heading('Modification du stream', 'fa-edit')
						->body($form_stream->display())
						->size('col-lg-12')
			)
		);
	}

	public function delete($stream_id, $title)
	{
		$this	->title('Suppression du stream')
				->subtitle($title)
				->form
				->confirm_deletion($this->lang('delete_confirmation'), 'Êtes-vous sûr de vouloir supprimer le stream <b>'.$title.'</b>');

		if ($this->form->is_valid())
		{
			$this->model()->delete_stream($stream_id);

			return 'OK';
		}

		echo $this->form->display();
	}
}

/*
NeoFrag Alpha 0.1.6.1
./modules/streams/controllers/admin.php
*/