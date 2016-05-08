<?php
class Welcome extends Controller {

  function __construct()
  {
    parent::Controller();
    //$this->output->cache(60);
  }

  function index($id=NULL)
  {
    
    /*Estrae programmazione*/
    $this->template['programmazione'] = $this->Programmazioni->get($id);

    /*Estrae dettagli*/
    $this->template['films'] = ($this->template['programmazione']) ? $this->Programmazioni->get_details($this->template['programmazione']['id']) : FALSE;

    if($this->template['films'])
      $this->template['metatitle'] = 'Programmazione '.titoloprogrammazione::titolo(
                                      $this->template['programmazione']['inizio']['giorno'],
                                      $this->template['programmazione']['inizio']['mese'],
                                      $this->template['programmazione']['fine']['giorno'],
                                      $this->template['programmazione']['fine']['mese'],
                                      false
                                      );
    else
      $this->template['metatitle'] = 'Programmazione';

    echo json_encode($this->template);


    $data = array(
      'useragent' => $_SERVER['HTTP_USER_AGENT']
    );

    $this->db->insert('tbl_api', $data);

    //var_dump($this->template);
  }
}
