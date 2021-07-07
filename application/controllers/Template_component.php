<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Template_component extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Template_component_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('template_component/template_component_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Template_component_model->json();
    }

    public function read($id)
    {
        $row = $this->Template_component_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_template' => $row->id_template,
                'id_component' => $row->id_component,
            );
            $this->load->view('template_component/template_component_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('template_component'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('template_component/create_action'),
            'id_template' => set_value('id_template'),
            'id_component' => set_value('id_component'),
        );
        $this->load->view('template_component/template_component_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_template' => $this->input->post('id_template', TRUE),
                'id_component' => $this->input->post('id_component', TRUE),
            );

            $this->Template_component_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('template_component'));
        }
    }

    public function update($id)
    {
        $row = $this->Template_component_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('template_component/update_action'),
                'id_template' => set_value('id_template', $row->id_template),
                'id_component' => set_value('id_component', $row->id_component),
            );
            $this->load->view('template_component/template_component_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('template_component'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('', TRUE));
        } else {
            $data = array(
                'id_template' => $this->input->post('id_template', TRUE),
                'id_component' => $this->input->post('id_component', TRUE),
            );

            $this->Template_component_model->update($this->input->post('', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('template_component'));
        }
    }

    public function delete($id)
    {
        $row = $this->Template_component_model->get_by_id($id);

        if ($row) {
            $this->Template_component_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('template_component'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('template_component'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_template', 'id template', 'trim|required');
        $this->form_validation->set_rules('id_component', 'id component', 'trim|required');

        $this->form_validation->set_rules('', '', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "template_component.xls";
        $judul = "template_component";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Id Template");
        xlsWriteLabel($tablehead, $kolomhead++, "Id Component");

        foreach ($this->Template_component_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->id_template);
            xlsWriteNumber($tablebody, $kolombody++, $data->id_component);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Template_component.php */
/* Location: ./application/controllers/Template_component.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-06 16:02:21 */
/* http://harviacode.com */