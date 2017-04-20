<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Book extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->library('jdf');

  }

  public function index() {
    $this->template->load('index');
  }

  public function category() {
    $category = htmlentities(urldecode($this->uri->segment(3)));
    $this->template->load('category', array('category' => $category));
  }

  public function focus() {
    $bookname = htmlentities(str_replace('-', ' ', urldecode($this->uri->segment(3))));
    $this->template->load('focus', array('bookname' => $bookname));
  }
    public function administrator(){
      $this->template->load('admin');

    }

  public function edit(){
    $bookname   = $_POST['bookname'];
    $authorname = $_POST['authorname'];
    $category   = $_POST['category'];
    $publishers = $_POST['publishers'];
    $textarea   = $_POST['textarea'];
    $date       = $_POST['date'];
    $bookid = $_POST['bookid'];

    $this->db->query("UPDATE bookz set bookname = '$bookname',author='$authorname', category= '$category',publishers = '$publishers',Description = '$textarea',`date` = '$date' WHERE book_id = $bookid");
header("Location: administrator");



  }






}
