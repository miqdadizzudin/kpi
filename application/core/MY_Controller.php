<?php defined('BASEPATH') || exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();


    }

}
/*End of MY Controller*/

class Admin_Controller extends CI_Controller
{
    protected $userData;

    public function __construct()
    {

        parent::__construct();
        $this->load->model('MY_Model');

        /*Check If user has logged in*/
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login');
        }

        $userData    = $this->user_data = $this->ion_auth->user()->row(); // Sedang login

        $user_groups = $this->ion_auth->get_users_groups()->result();
        $userData->group = $user_groups;

        // ID User
        $id_user_login =  $userData->id; 

        $resultsUmum = $this->MY_Model->get_recordsUmum($id_user_login);
        $this->template->set('resultsUmum', $resultsUmum);

        // Protected above
        $this->userData = $userData; 

        $this->form_validation->set_error_delimiters('', '');

        $resultsJabatan_Umum = $this->MY_Model->get_jabatan($id_user_login);
        $this->template->set('resultsJabatan_Umum', $resultsJabatan_Umum);

        // Basic setup
        $this->template->set('userData', $userData);
        $this->template->set_theme('admin');
        $this->template->set_layout('index');

        $this->form_validation->set_error_delimiters('<p>','</p>');
    }
}
/* End of file Admin_Controller.php */

class Front_Controller extends MY_Controller
{
    /**
     * Class constructor
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->template->set_theme('default');
        $this->template->set_layout('index');
    }//end __construct()

    //--------------------------------------------------------------------

}
/*End of Front Controller*/

?>