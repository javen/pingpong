<?php
/**
* Result Model 
*
* @author Javen Chen
*/
class Result extends CI_Model {

    private $id;
    private $a_group;
    private $b_group;
    private $c_group;
    private $d_group;
    private $e_group;
    private $start_time;
	private $end_time;

	function __construct()
	{
		// 因为autoload.php line61: $autoload['libraries'] = array('database');
	    // $this->load->database();
	}

	public function get_results()
	{
		$query = $this->db->get('result');
		return $query->result_array();
	}

	public function create_results($data)
	{
		$this->load->helper('url');

		// $data = [
		//     'a_group'    => $a_group,
		//     'b_group'    => $b_group,
		//     'c_group'    => $c_group,
		//     'd_group'    => $d_group,
		//     'e_group'    => $e_group,
		//     'start_time' => $start_time,
		//     'end_time'   => $end_time,
		// ];

		return $this->db->insert('result', $data);
	}

	public function update_results($id, $data)
	{
		$this->load->helper('url');	

		if (((int) $id) > 0) 
		{
			$this->db->where('id', $id);
			return $this->db->update('result', $data);
		} 
		else 
		{
		 	return FALSE;
		}
	}

	public function delete_results($id)
	{
		$this->load->helper('url');
				
		if (((int) $id) > 0) {
			$this->db->where('id', $id);
			return $this->db->delete('result');
		} 
		else 
		{
		 	return FALSE;
		}
	}
}
