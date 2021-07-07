<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Component extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Component_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('component/component_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Component_model->json();
    }

    public function read($id)
    {
        $row = $this->Component_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'name' => $row->name,
                'value' => $row->value,
            );
            $this->load->view('component/component_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('component'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('component/create_action'),
            'id' => set_value('id'),
            'name' => set_value('name'),
            'value' => set_value('value'),
        );
        $this->load->view('component/component_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'name' => $this->input->post('name', TRUE),
                'value' => $this->input->post('value', TRUE),
            );

            $this->Component_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('component'));
        }
    }

    public function update($id)
    {
        $row = $this->Component_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('component/update_action'),
                'id' => set_value('id', $row->id),
                'name' => set_value('name', $row->name),
                'value' => set_value('value', $row->value),
            );
            $this->load->view('component/component_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('component'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'name' => $this->input->post('name', TRUE),
                'value' => $this->input->post('value', TRUE),
            );

            $this->Component_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('component'));
        }
    }

    public function delete($id)
    {
        $row = $this->Component_model->get_by_id($id);

        if ($row) {
            $this->Component_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('component'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('component'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('value', 'value', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "component.xls";
        $judul = "component";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Name");
        xlsWriteLabel($tablehead, $kolomhead++, "Value");

        foreach ($this->Component_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->name);
            xlsWriteLabel($tablebody, $kolombody++, $data->value);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Component.php */
/* Location: ./application/controllers/Component.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-06 16:02:21 */
/* http://harviacode.com */