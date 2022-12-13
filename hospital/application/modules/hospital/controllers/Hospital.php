<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hospital extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->Model('hospital_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        //session load library
    }
    public function index()
    {
        $data['countries'] = $this->hospital_model->country();
        // var_dump($data);
        $this->load->view('registration', $data);
        //registraion page as main page for now
    }

    public function provinceFetch()
    {
        $country_id = $this->input->post('country');
        $province = $this->hospital_model->province($country_id);
        // var_dump($province);
        $data = [];
        $data['province'] = $province;
        $provincePost = $this->load->view('province', $data, true);
        $successMessage['province'] = $provincePost;
        echo json_encode($successMessage);

        //fetching provinces and view
    }

    public function municipalFetch()
    {
        $prov_id = $this->input->post('province');
        $municples = $this->hospital_model->municipal($prov_id);

        $data = [];
        $data['mun'] = $municples;
        $municplesPost = $this->load->view('municipalities', $data, true);
        $message['mun'] = $municplesPost;
        echo json_encode($message);

        //fetching municipality from model function and view
    }

    public function insertRegistrationData()
    {
        // inserting tthe value to datase
        // array to check the message
        $checkdata = [];
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('age', 'Age', 'required|numeric');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('language', 'Language', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('countryname', 'Country', 'required');
        $this->form_validation->set_rules('provincename', 'Province', 'required');
        $this->form_validation->set_rules('munipality', 'Muncipality', 'required');
        $this->form_validation->set_rules('mobile', 'mobile', 'required|numeric|exact_length[10]');
        // form validation rules
        if ($this->form_validation->run() == true) {
            $name = $this->input->post('name');
            $age = $this->input->post('age');
            $gender = $this->input->post('gender');
            $language = $this->input->post('language');
            $countryname = $this->input->post('countryname');
            $provincename = $this->input->post('provincename');
            $munipality = $this->input->post('munipality');
            $address = $this->input->post('address');
            $mobile = $this->input->post('mobile');
            $patient_id = $this->input->post('patientid');
            $date = $this->input->post('date');
            $muncipality_id = $this->input->post('municipality_id');
            // get inputs navigated from form

            $navigate = $this->hospital_model->registration($name, $age, $gender, $language, $countryname, $provincename, $munipality, $address, $mobile, $patient_id, $date, $muncipality_id);
            // insert from model fucntion call
            if ($navigate) {
                //succcess message in array
                $checkdata = array(
                    'status' => 'success',
                    'message' => "Registered successfully"
                );
            } else {
                $checkdata = array(
                    'status' => 'failed',
                    'message' => "Registration Invalid"
                );
            }
            //validation errror messages
        } else {
            $checkdata = array(
                'status' => 'failed',
                'message' => validation_errors()

            );
            // $this->load->view('registration');
        }
        // encode data for validation error or success message
        echo json_encode($checkdata);
    }
    // random function to get last patient id
    public function rand()
    {
        $rand = $this->hospital_model->patients_id();
        echo json_encode($rand);
    }
    // get last sample number from database
    public function sample_number()
    {
        $random = $this->hospital_model->sample_number();
        echo json_encode($random);
    }
    // patient detail function
    public function patientDetails()
    {
        $patient['patient'] = $this->hospital_model->patients();
        $this->load->view('managePatients', $patient);
    }



    public function preview()
    {
        $id = $this->input->get('patientid');
        $patientid = $this->input->post('patientid');
        $this->session->set_flashdata('patientid', $id); 
        $this->session->set_flashdata('idPatient', $patientid);//pass patient id to another function
    }
    public function viewPreviewData()
    {
        $id = $this->session->flashdata('patientid'); //get data patent id
        if ($id) {
            $data['arr'] = $this->hospital_model->previewFromPatientId($id);
            $this->load->view('preview', $data);
            
        } else {
            echo "nodata";
        }
    }
    public function admin(){
        $this->load->view('adminlogin');
    }
    public function logout(){
        $this->load->view('logout');
    }
    public function fetchSinglePatient(){
        $patient_id = $this->session->flashdata('patientid'); //get data patent id
        echo json_encode($patient_id);

    }
    public function billing()
    {
        $patient_id = $this->session->flashdata('patientid'); //get data patent id
        if ($patient_id) {
            $test['patienttestings'] = $this->hospital_model->registrationBillingAndItems($patient_id);
            // $row['row'] = $this->hospital_model->patientBillings($patient_id);
            $this->load->view('billing', $test);
        } else {
            $this->load->view('billing');
        }
    }
    public function billingTotal(){ //get total billing
        $patient_id = $this->session->flashdata('patientid');
        $total = $this->hospital_model->registrationBillingAndItems($patient_id);
        echo json_encode($total);
    }
    public function billingPreview(){
        $patient_id = $this->session->flashdata('patientid'); 
        $test = $this->hospital_model->registrationBillingAndItems($patient_id);
        // $this->load->view('preview', $test);
        echo json_encode($test);
    }

    public function insertToBilling()
    {
        //validations rules and array to fetch success message in view
        $checkdata = [];
        $this->form_validation->set_rules('patient_id', 'Patient id', 'required|numeric');
        $this->form_validation->set_rules('net_total', 'Net total', 'required|numeric');
        $this->form_validation->set_rules('discount_amount', 'Discount Amount', 'required|numeric');
        $this->form_validation->set_rules('test_item', 'Test Item Name', 'required');
        $this->form_validation->set_rules('quanity', 'Quantity', 'required');
        $this->form_validation->set_rules('unit', 'Unit', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
    // condition if form is validated
        if ($this->form_validation->run() == true) {
            $patient_id = $this->input->post('patient_id');
            $sample_no = $this->input->post('sample_no');
            $billing_date = $this->input->post('billing_date');
            $subtotal = $this->input->post('subtotal');
            $discout_percent = $this->input->post('discout_percent');
            $discount_amount = $this->input->post('discount_amount');;
            $net_total = $this->input->post('net_total');
            $test_items =$this->input->post('test_item');
            $quantity = $this->input->post('quanity');
            $unit = $this->input->post('unit');
            $price = $this->input->post('price');
            $success = $this->hospital_model->insertIntoBillings($patient_id, $sample_no, $billing_date, $subtotal, $discout_percent, $discount_amount, $net_total);
            //call to insert function from hospital model
            $item = $this->hospital_model->insertIntoItems($patient_id,$sample_no,$test_items,$quantity,$unit,$price);
            if ($success && $item) {
                $checkdata = array(
                    'status' => 'success',
                    'message' => "Billing Inserted successfully"
                );
            } else {
                $checkdata = array(
                    'status' => 'failed',
                    'message' => "Billing Invalid"
                );
            }
        } else {
            $checkdata = array(
                'status' => 'failed',
                'message' => validation_errors()

            );
        }
        // send message to view
        echo json_encode($checkdata);
    }

    public function fetchPatientId()
    {
        //fetch patient id 
        $val = $this->hospital_model->patientId();
        echo json_encode($val);
    }

    public function billingsAndTotal(){
        $patient_id = $this->session->flashdata('patientid'); 
        $test['billingtotal'] = $this->hospital_model->registrationBillingAndItems($patient_id);
        $this->load->view('patientBilling', $test);
    }

    public function sumOfBillings(){
        $patient_id = $this->session->flashdata('patientid'); 
        $price = $this->hospital_model->sumofPrice($patient_id);//get sum
        echo json_encode($price);
    }


    public function sumofNetTotal(){
        $patient_id = $this->session->flashdata('patientid'); 
        $nettotal = $this->hospital_model->sumofNetTotal($patient_id); //get sum
        echo json_encode($nettotal);
    }
    public function sumofDiscountAmount(){
        $patient_id = $this->session->flashdata('patientid'); 
        $discount = $this->hospital_model->sumofDiscountAmoung($patient_id);//get sum
        echo json_encode($discount);
    }

    public function sumOfSubTotal(){
        $patient_id = $this->session->flashdata('patientid'); 
        $sub_total = $this->hospital_model->sumOfSubTotal($patient_id);//get sum
        echo json_encode($sub_total);
    }

    public function delete(){
        $patient_id = $this->session->flashdata('idPatient'); 
        $pid = $this->input->post('patientid');
        $sub_total = $this->hospital_model->delete($pid);//get sum
    }
}
