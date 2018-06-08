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

class m_streams_m_streams extends Model
{
	public function get_streams()
	{
		return $this->db->select('*')
						->from('nf_streams')
						->get();
	}

	public function check_stream($stream_id, $title)
	{
		return $this->db	->select('stream_id', 'title', 'url', 'id', 'provider')
							->from('nf_streams')
							->where('stream_id', $stream_id)
							->row();
	}

	public function add_stream($title, $url, $id, $provider)
	{
		$this->db->insert('nf_streams', [
			'title'    => $title,
			'url'      => $url,
			'id'       => $id,
			'provider' => $provider
		]);
	}

	public function edit_stream($stream_id, $title, $url, $id, $provider)
	{
		$this->db	->where('stream_id', $stream_id)
					->update('nf_streams', [
						'title'    => $title,
						'url'      => $url,
						'id'       => $id,
						'provider' => $provider
					]);
	}

	public function delete_stream($stream_id)
	{
		$this->db	->where('stream_id', $stream_id)
					->delete('nf_streams');
	}
}

/*
NeoFrag Alpha 0.1.6.1
./modules/streams/models/streams.php
*/