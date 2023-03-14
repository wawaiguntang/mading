<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Roles_model extends CI_Model
{

	var $table = 'role';
	var $column_order = array('role'); //set column field database for datatable orderable
	var $column_search = array('role'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('roleCode' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{

		$this->db->from($this->table)->where('deleteAt',NULL)->where('status','Dynamic');

		$i = 0;

		foreach ($this->column_search as $item) // loop column 
		{
			if (isset($_POST['search']['value'])) // if datatable send POST for search
			{

				if ($i === 0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}

		if (isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if (isset($_POST['length'])) {
			if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
		}
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table)->where('deleteAt',NULL)->where('status','Dynamic');
		return $this->db->count_all_results();
	}

	public function get_all()
	{
		$this->db->from($this->table);
		$this->db->where('deleteAt',NULL)->where('status','Dynamic');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('roleCode', $id)->where('deleteAt',NULL);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
        $data['updateAt'] = date('Y-m-d H:i:s');
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$data['deleteAt'] = date('Y-m-d H:i:s');
		$this->db->update($this->table, $data, ['roleCode' => $id]);
		return $this->db->affected_rows();
	}

	public function get_permission_id($id)
	{
		$this->db->select('rp.rpCode,r.permissionCode,r.permission,r.description');
		$this->db->join('permission r','r.permissionCode=rp.permissionCode');
		$this->db->from('role_permission rp');
		$this->db->where('rp.roleCode', $id);
		$this->db->where('rp.deleteAt', NULL);
		$this->db->where('r.deleteAt', NULL);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function get_role_permission_id($id)
	{
		$this->db->from('role_permission');
		$this->db->where('rpCode', $id)->where('deleteAt',NULL);
		$query = $this->db->get();

		return $query->row();
	}

	public function delete_role_permission_id($id)
	{
		$data['deleteAt'] = date('Y-m-d H:i:s');
		$this->db->update('role_permission', $data, ['rpCode' => $id]);
		return $this->db->affected_rows();
	}
}