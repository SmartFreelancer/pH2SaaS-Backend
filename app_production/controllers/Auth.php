<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller
{

    function __construct() {
        parent::__construct();
    }

    public function login() {

        // If the user is already login, redirect them
        if ($this->ion_auth->logged_in()) {
            redirect('dashboard');
            exit();
        }

        $this->data['page_title'] = "Login";

        $this->load->view('header', $this->data);
        $this->load->view('auth/login', $this->data);
        $this->load->view('footer', $this->data);
    }

    public function login_ajax() {
        if ($this->input->is_ajax_request()) {

            $remember = (bool)$this->input->post('remember');
            $login_chk = $this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember);

            if ($login_chk) {
                echo json_encode(array('success' => true, 'message' => 'Login accepted, please wait while we redirect you to the dashboard.'));
            }
            else {
                echo json_encode(array('success' => false, 'message' => "The email and password you entered don't match."));
            }
        }
        else {
            redirect('/');
        }
    }

    public function auto_login() {
        $this->session->sess_destroy();
        $do = $this->ion_auth->login($this->session->flashdata('auto_identity'), $this->session->flashdata('auto_pass'), $remember = TRUE);
        if ($do) {
            redirect('dashboard');
        }
        else {
            redirect('login');
        }
    }

    public function logout() {
        $this->ion_auth->logout();
        redirect('/');
    }

    public function payment_register() {

        // Check for user ID in the session
        //if (!$this->session->userdata('reg_userid')) {
          //  redirect('/');
          //  exit();
        //}

        $this->data['email'] = $this->session->userdata('email');
        $this->data['page_title'] = "Create Your Account";

        $this->load->view('header', $this->data);
        $this->load->view('auth/payment_register', $this->data);
        $this->load->view('footer', $this->data);
    }

    public function payment_register_ajax() {
        if ($this->input->is_ajax_request()) {

            $email = trim(strtolower($this->input->post('email')));

            // Check email
            if ($this->ion_auth_model->email_check($email) == true) {
                echo json_encode(array('success' => false, 'message' => "This email address already exists. If your unable to access your account please <a href='" . base_url() . "support'>contact support here</a>."));
                exit();
            }
            else {

                // additional info username or real name
                if ($this->data['require_username']) {
                    $username = trim(strtolower($this->input->post('username')));

                    if ($this->ion_auth_model->username_check($username) == true) {
                        echo json_encode(array('success' => false, 'message' => "This username is already taken, try something else."));
                        exit();
                    }
                    $this->ion_auth_model->update($this->session->userdata('reg_userid'), array("username" => $username));
                    $this->data['member_name'] = $username;
                }
                else {
                    $this->ion_auth_model->update($this->session->userdata('reg_userid'), array("first_name" => trim($this->input->post('first_name')), "last_name" => trim($this->input->post('last_name'))));
                    $this->data['member_name'] = trim($this->input->post('first_name'));
                }
                $this->ion_auth_model->update($this->session->userdata('reg_userid'), array("email" => $email, "password" => trim($this->input->post('password'))));

                // Send user membership welcome email
                $this->data['plan_expire'] = date('M d, Y', strtotime("+" . $this->session->userdata('plan_period') . " day"));
                $this->data['msg_email'] = $email;

                $message = $this->load->view($this->config->item('email_templates', 'ion_auth') . $this->config->item('welcome', 'ion_auth'), $this->data, true);
                $this->email->from($this->data['general_email'], $this->data['site_name'] . ' Support');
                $this->email->to($email);
                $this->email->subject('Welcome to ' . $this->data['site_name'] . '');
                $this->email->message($message);
                $this->email->send();
                if ($this->email->send() == FALSE) {
                    log_message('error', 'Unable to send welcome email to: ' . $email . '');
                }

                $this->session->set_flashdata('auto_pass', $this->input->post('password'));
                $this->session->set_flashdata('auto_identity', $email);

                echo json_encode(array('success' => true, 'message' => 'All done, please wait while we redirect you to your account.'));
            }
        }
        else {
            redirect('/');
        }
    }

    public function lead() {
        $this->load->view('auth/capture_lead', $this->data);
    }

    public function lead_ajax() {
        if ($this->input->is_ajax_request()) {
            $this->load->model('billing_mdl');

            // Add lead
            $add_lead = $this->billing_mdl->add_lead(array('email' => trim($this->input->post('email')), 'person_name' => trim($this->input->post('user_name')), 'date' => time()));
            $this->session->set_userdata('email', trim($this->input->post('email')));

            if ($add_lead) {
                echo json_encode(array('success' => true, 'message' => ''));
            }
            else {
                log_message('error', 'Unable to add lead data in to the database EMAIL: ' . trim($this->input->post('email')) . ' NAME: ' . trim($this->input->post('user_name')) . '');
                echo json_encode(array('success' => true, 'message' => ''));
            }
        }
        else {
            redirect('/');
        }
    }

    public function contributor_request() {
        if ($this->input->is_ajax_request()) {
            $this->load->model('account_mdl');

            $email = trim(strtolower($this->input->post('email')));
            $username = trim(strtolower($this->input->post('username')));

            // Check email
            if ($this->ion_auth_model->email_check($email) == true) {
                echo json_encode(array('success' => false, 'message' => "Seems like you already have an account with us. If your contribution period is up and you would like to start a new one, please <a href='" . base_url() . "support'>open a support ticket here</a>."));
                exit();
            }
            else if ($this->ion_auth_model->username_check($username) == true) {
                echo json_encode(array('success' => false, 'message' => "This username is already taken, try something else."));
                exit();
            }
            else {
                $add_contributor = $this->account_mdl->add_contributor( array("ip_address" => $this->input->ip_address(), "username" => $username, "email" => $email, "msg" => $this->input->post('msg')) );

                if ($add_contributor) {
                    echo json_encode(array('success' => true, 'message' => 'Your request has been submitted. We will contact you shortly via email if you have been selected.'));
                }
                else {
                    log_message('error', 'Unable to add contributor request to the database EMAIL: ' . trim($this->input->post('email')) . '');
                    echo json_encode(array('success' => false, 'message' => ''));
                }
            }
        }
        else {
            redirect('/');
        }
    }


}
