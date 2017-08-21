<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Keyword_generator extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->data['user']->membership_payment == 0) {
            redirect('membership-disabled');
        }
    }

    public function index()
    {
        $this->data['page_title'] = "Keyword Generator";

        $this->load->view('header', $this->data);
        $this->load->view('head_nav', $this->data);
        $this->load->view('tools/keyword_generator/main', $this->data);
        $this->load->view('footer', $this->data);
    }

    public function process_data()
    {
        // only allow access via Ajax request
        if ($this->input->is_ajax_request()) {

            $keywords_suggest = $this->input->post('keywords');
            $keywords_suggest = str_replace("\r\n", "\n", $keywords_suggest);
            $keywords_suggest = str_replace(",", "\n", $keywords_suggest);
            $keywords_suggest = strtolower($keywords_suggest);

            $listarr = explode("\n", $keywords_suggest);
            $wordarr = array();

            foreach ($listarr as $i) {
                $wordarr[] = trim($i);
            }

            $results = array();
            foreach ($wordarr as $w) {
                $words = $this->keyword_response($w);
                foreach ($words as $word) {
                    $results[] = ucwords($word);
                }
            }

            $this->data['keywords_result'] = $results;

            $this->load->view('tools/keyword_generator/process_data', $this->data);
        } else {
            redirect('/', 'refresh');
        }
    }

    private function keyword_response($keywords)
    {
        $keywords_list = array();
        $data = page_get('https://suggestqueries.google.com/complete/search?output=firefox&client=firefox&hl=en-US&q=' . urlencode($keywords));
        if (($data = json_decode($data, true)) !== null) {
            $keywords_list = $data[1];
        }
        return $keywords_list;
    }

    public function tool_training()
    {
        $this->data['page_title'] = "Keyword Generator Training";

        $this->load->view('header', $this->data);
        $this->load->view('head_nav', $this->data);
        $this->load->view('tools/keyword_generator/tool_training', $this->data);
        $this->load->view('footer', $this->data);
    }


} /* End of file keyword_generator.php */
/* Location: ./application/controllers/tools/keyword_generator.php */
