<?php
class Select extends CI_Model {

  public function Selectindex(){
     $this->db->get('bookz');
  }

}