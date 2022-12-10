<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Hospital_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
    }
    public function country()
    {
        $countries = $this->db->get('countries')->result_array();
        return $countries; // return array of countries
    }
    public function province($country_id)
    {
        $this->db->where('country_id', $country_id);
        $province = $this->db->get('provinces')
            ->result_array();
        return $province; // return province
    }
    public function municipal($province_id)
    {
        $this->db->where('province_id', $province_id);
        $municiples = $this->db->get('municiples')
            ->result_array();
        return $municiples; //return all the municipalites data
    }
    public function registration($name, $age, $gender, $language, $countryname, $provincename, $munipality, $address, $mobile, $patient_id, $date, $municipality_id)
    {
        $dataInsertion = $this->db->set('name', $name)
            ->set('age', $age)
            ->set('gender', $gender)
            ->set('language', $language)
            ->set('country', $countryname)
            ->set('province', $provincename)
            ->set('municipality', $munipality)
            ->set('address', $address)
            ->set('mobile', $mobile)
            ->set('patient_id', $patient_id)
            ->set('date', $date)
            ->set('municipality_id', $municipality_id)
            ->insert('patients');
        // insert data to patients
        if ($dataInsertion) {
            return true;
            //bool
        } else {
            return false;
        }
    }

    public function patients()
    { // get districts from another table in patient
        $this->db->select('*');
        $this->db->join('patients', 'patients.municipality_id = districts.municipality_id');
        $this->db->order_by("patient_id", 'DESC');
        $data = $this->db->get('districts')->result_array();
        return $data;
    }

    public function patients_id()
    { // get last patient id for auto increment in database through view
        $last_record = $this->db->order_by('id', "desc")
            ->limit(1)
            ->get('patients')
            ->row();
        return $last_record;
    }

    public function sample_number()
    { // get last sample number
        $last_record = $this->db->order_by('id', "desc")
            ->limit(1)
            ->get('billings')
            ->row();
        return $last_record;
    }

    public function districs()
    { // districtss
        $districts = $this->db->get('districts')->result_array();
        return $districts;
    }

    public function previewFromPatientId($id)
    { //get all the patient data from id
        $arr = array('patient_id' => $id);
        $patient = $this->db->get_where('patients', $arr)->result_array();
        return $patient;
    }

    public function patientBillings($patient)
    { //patient_id from billing (query) row selected
        $this->db->select('patient_id');
        $data = $this->db->get_where('billings', array('patient_id' => $patient));
        return $data->row();
    }

    public function patientId()
    { // fetch patient id
        $this->db->select('patient_id');
        $patient = $this->db->get('patients')->result_array();
        return $patient;
    }
    // insert to the database 
    public function insertIntoBillings($patient_id, $sample_no, $billing_date, $subtotal, $discout_percent, $discount_amount, $net_total)
    {
        $dataInsert = $this->db->set('patient_id', $patient_id)
            ->set('sample_no', $sample_no)
            ->set('billing_date', $billing_date)
            ->set('subtotal', $subtotal)
            ->set('discount_percent', $discout_percent)
            ->set('discount_amount', $discount_amount)
            ->set('net_total', $net_total)
            ->insert('billings');

        if ($dataInsert) {
            return true;
            //bool condition
        } else {
            return false;
        }
    }

    // insert to the database 
    public function insertIntoItems($patient_id, $sample_no, $test_items, $quantity, $unit, $price)
    {
        $dataInsert = $this->db->set('patient_id', $patient_id)
            ->set('sample_no', $sample_no)
            ->set('test_items', $test_items)
            ->set('quantity', $quantity)
            ->set('unit', $unit)
            ->set('price', $price)
            ->insert('items');

        if ($dataInsert) {
            return true;
            //bool condition
        } else {
            return false;
        }
    }

    public function registrationBillingAndItems($id)
    {
        $this->db->select('*'); // Select field
        $this->db->from('billings'); // from Table1
        $this->db->join('items', 'billings.sample_no = items.sample_no'); // Join table1 with table2 based on the foreign key
        $this->db->where('billings.patient_id', $id); // Set Filter
        $res = $this->db->get()->result_array();
        return $res;
    }

    public function sumofPrice($id){
        $where = array('patient_id'=>$id);
        $data=$this->db
        ->select_sum('price')
        ->get_where('items',$where);
         return $data->row();
    }
    public function sumofNetTotal($id){
        $where = array('patient_id'=>$id);
        $data=$this->db
        ->select_sum('net_total')
        ->get_where('billings',$where);
         return $data->row();
    }
    public function sumofDiscountAmoung($id){
        $where = array('patient_id'=>$id);
        $data=$this->db
        ->select_sum('discount_amount')
        ->get_where('billings',$where);
         return $data->row();
    }
    public function sumOfSubTotal($id){
        $where = array('patient_id'=>$id);
        $data=$this->db
        ->select_sum('subtotal')
        ->get_where('billings',$where);
         return $data->row();
    }
}
