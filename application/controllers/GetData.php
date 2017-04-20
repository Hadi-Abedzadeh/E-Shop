<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class GetData extends CI_Controller {

  public function index($pageIndex) {
    header('Content-Type: text/text');

    $this->load->library('jdf');
    $itemCount = 4;
    $itemIndex = ($pageIndex - 1) * $itemCount;
    $query = $this->db->query("SELECT author.author_name, author.about ,bookz.* FROM author INNER JOIN bookz limit $itemIndex,$itemCount");
    $pageZ = $this->db->query("SELECT author.author_name, author.about ,bookz.* FROM author INNER JOIN bookz");


    foreach ($query->result() as $row) {
      if ($row->discount >= 1) { ?>
        <li
          class='post-70 product type-product status-publish has-post-thumbnail book_author-atkia product_cat-science product_tag-money product_tag-novel product_tag-culture  instock sale featured shipping-taxable purchasable product-type-simple'>
          <div class='product-inner'>
            <a href='<?= 'Book/focus/' . str_replace(' ', '-', $row->bookname) ?>' class='woocommerce-LoopProduct-link'>
              <span class="onsale">تخفیف!</span>
              <img
                src="assets/upload/<?= str_replace(' ', '-', urldecode($row->publishers . '-' . $row->author_name . '-' . $row->bookname)) . ".jpg" ?>"
                class="attachment-shop_catalog size-shop_catalog wp-post-image"
                alt="<?= $row->author_name . '-' . $row->bookname ?>"
                title="<?= $row->author_name . '-' . $row->bookname ?>"
                >

              <div class="product-price-box clearfix">
                <h3><?=$row->bookname?></h3><span
                  class="person-name vcard"><?=$row->author_name;?></span>
                      <span class="price">
                      <del><span class="woocommerce-Price-amount amount"><?=$this->jdf->tr_num($row->price, 'fa')?>
                          &nbsp;<span
                            class="woocommerce-Price-currencySymbol">تومان</span></span></del>
                      <ins><span
                          class="woocommerce-Price-amount amount"><?=$this->jdf->tr_num($row->price - ($row->price * $row->discount) / 100, 'fa');?>
                          &nbsp;<span class="woocommerce-Price-currencySymbol">تومان</span></span>
                      </ins>
                      </span>
              </div>
              <div class="woo-button-wrapper">
                <div class="woo-button-border">
                  <a href="<?= 'Book/focus/' . str_replace(' ', '-', $row->bookname) ?>"
                     class="button product-button">جزییات</a><a rel="nofollow"
                                                                href='http://systemcode.ir/Hadi-Abedzadeh/Payment/Request/<?= $row->isbn ?>'
                                                                class="button product_type_simple add_to_cart_button ajax_add_to_cart">خرید</a>
                </div>
              </div>
            </a>
          </div>
        </li>
      <? } else {
        ?>
        <li
          class='post-70 product type-product status-publish has-post-thumbnail book_author-atkia product_cat-science product_tag-money product_tag-novel product_tag-culture  instock sale featured shipping-taxable purchasable product-type-simple'>
          <div class='product-inner'>
            <a href='<?= 'Book/focus/' . str_replace(' ', '-', $row->bookname) ?>' class='woocommerce-LoopProduct-link'>
              <img
                src="assets/upload/<?= str_replace(' ', '-', urldecode($row->publishers . '-' . $row->author_name . '-' . $row->bookname)) . ".jpg" ?>"
                class="attachment-shop_catalog size-shop_catalog wp-post-image"
                alt="<?= $row->author_name . '-' . $row->bookname ?>"
                title="<?= $row->author_name . '-' . $row->bookname ?>"
                >

              <div class="product-price-box clearfix">
                <h3><?=$row->bookname?></h3>
                <span class="person-name vcard"><?=$row->author_name;?></span>
                      <span class="price">
                      <ins>
                        <span class="woocommerce-Price-amount amount"><?=$this->jdf->tr_num($row->price, 'fa')?>
                          &nbsp;<span class="woocommerce-Price-currencySymbol">تومان</span></span>
                      </ins>
                      </span>
              </div>
              <div class="woo-button-wrapper">
                <div class="woo-button-border">
                  <a href="<?= 'Book/focus/' . str_replace(' ', '-', $row->bookname); ?>"
                     class="button product-button">جزییات</a><a rel="nofollow"
                                                                href='http://systemcode.ir/Hadi-Abedzadeh/Payment/Request/<?= $row->isbn ?>'
                                                                class="button product_type_simple add_to_cart_button ajax_add_to_cart">خرید</a>
                </div>
              </div>
            </a>
          </div>
        </li>
        <?
      }
    }

    echo '<div style="clear: both"></div>';
    $pageZ = ceil($pageZ->num_rows() / 4);
    for ($i = $pageIndex - 3; $i <= $pageIndex + 3; $i++) {
      if ($i <= 0) {
        continue;
      }
      if ($i >= $pageZ) {
        continue;
      }
      if ($i == $pageIndex) {
        ?>
        <span class="btn" style="background:red;"><?=$i?></span>
        <?
      } else {
        ?>
        <span class="btn btn-blue" onclick="getdata(<?= $i ?>)"><?=$i?></span>
        <?
      }
    } ?>
    <span>..</span>
    <span class="btn btn-blue" onclick="getdata(<?= $pageZ ?>)"><?=$pageZ?></span>

    <?
  }

  public function adminPageData($pageIndex) {
    header('Content-Type: text/text');

    $this->load->library('jdf');
    $itemCount = 4;
    $itemIndex = ($pageIndex - 1) * $itemCount;
    $query = $this->db->query("SELECT author.author_name, author.about ,bookz.* FROM author INNER JOIN bookz limit $itemIndex,$itemCount");
    ?>


    <?

    foreach ($query->result() as $row) {
      ?>
      <div class="postList active">
          <form action="edit" method="post">
        <div class="col-sm-1 pull-right" style="padding:0;">
              <img id="imgUP" style="height: 100px;" src="../assets/upload/<?= str_replace(' ', '-', urldecode($row->publishers . '-' . $row->author_name . '-' . $row->bookname)) . ".jpg" ?>">
        </div>

  <span style="position: relative;right: 24px;">

    <div>
      <span>نام کتاب:</span>
      <input name="bookname" type="text" style="width:120px;" value="<?= $row->bookname ?>">
    </div>

    <div>
      <span> نام نویسنده:</span>
      <input name="authorname" type="text" style="width:180px;" value="<?= $row->author_name ?>">
    </div>

    <div>
      <span>دسته بندی</span>
      <select name="category" style="width:100px;">
        <option>بی دسته</option>
        <option value="<?= $row->category?>"><?=$row->category?></option>
      </select>
    </div>


    <div>
          <span>انتشارات:</span>
            <select name="publishers" style="width:100px;">
              <option>انتشارات</option>
              <option value="<?= $row->publishers ?>"><?=$row->publishers?></option>
           </select>
    </div>
<div>
        <textarea name="textarea" style="margin: 0 0 16px;width: 883px;height: 206px;"><?=$row->Description?></textarea><br>

  </div>
        <div style="position: relative;top:20px;"><input name="date" type="text" value="<?=$row->date?>"></div>
      </span><br>
        <div style="clear: both"></div>
            <input name="bookid" type="hidden" value="<?=$row->book_id?>">
        <input type="submit" value="ثبت">
        </form>
      </div>

      <?
    }
    $pageZ = $this->db->query("SELECT author.author_name, author.about ,bookz.* FROM author INNER JOIN bookz");

    echo '<div style="clear: both"></div>';
    $pageZ = ceil($pageZ->num_rows() / $itemCount);
    for ($i = $pageIndex - 3; $i <= $pageIndex + 3; $i++) {
      if ($i <= 0) {
        continue;
      }
      if ($i >= $pageZ) {
        continue;
      }
      if ($i == $pageIndex) {
        ?>
        <span class="btn" style="background:red;"><?=$i?></span>
        <?
      } else {
        ?>
        <span class="btn btn-blue" onclick="getdata(<?= $i ?>)"><?=$i?></span>
        <?
      }
    } ?>
    <span>..</span>
    <span class="btn btn-blue" onclick="getdata(<?= $pageZ ?>)"><?=$pageZ?></span>
    <?


  }
}


?>