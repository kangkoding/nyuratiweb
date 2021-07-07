<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Template_component_model extends CI_Model
{

    public $table = 'template_component';
    public $id = '';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_template,id_component');
        $this->datatables->from('template_component');
        //add this line for join
        //$this->datatables->join('table2', 'template_component.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('template_component/read/$1'),'Read')." | ".anchor(site_url('template_component/update/$1'),'Update')." | ".anchor(site_url('template_component/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), '');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('', $q);
	$this->db->or_like('id_template', $q);
	$this->db->or_like('id_component', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('', $q);
	$this->db->or_like('id_template', $q);
	$this->db->or_like('id_component', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Template_component_model.php */
/* Location: ./application/models/Template_component_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-06 16:02:21 */
/* http://harviacode.com */