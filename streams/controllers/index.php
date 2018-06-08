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

class m_streams_c_index extends Controller_Module
{
	public function index()
	{
		$panels = [];

		foreach ($this->model()->get_streams() as $stream)
		{
			$panel = $this->view('streams', [
				'title'     => $stream['title'],
				'url'       => $stream['url'],
				'id'        => $stream['id'],
				'stream_id' => $stream['stream_id']
			]);

			$panels[] = $panel;
		}

		if (empty($panels))
		{
			$panels[] = $this	->panel()
								->heading('Streams', 'fa-video-camera')
								->body('<div class="text-center">Aucun stream</div>')
								->color('info');
		}

		return $panels;
	}

	public function _stream($stream_id, $title, $url, $id, $provider)
	{
		$this->title($title);

		return $this->panel()
					->heading('<div class="pull-right"><a href="'.url('streams').'" class="btn btn-default btn-xs">Retour</a></div>'.$title, 'fa-video-camera')
					->body($this->load->view('streamer', [
						'title'     => $title,
						'url'       => $url,
						'id'        => $id,
						'stream_id' => $stream_id
					]), FALSE);
	}
}

/*
NeoFrag Alpha 0.1.6.1
./modules/streams/controllers/index.php
*/