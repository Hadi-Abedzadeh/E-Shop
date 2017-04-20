<?php
$authors = $this->db->query("SELECT author_name FROM author");
$categorys = $this->db->query("SELECT catname  FROM category");

?>


<div class="toko-slider-wrap">
  <br>
  <br>
  <br>
</div>
<div class="main-content">
  <div class="main-content-container container">
    <div id="content" class="main-content-inner">
      <article id="post-701" class="post-701 page type-page status-publish entry">

        <div class="entry-content">
          <div class="vc_row wpb_row vc_row-fluid vc_row-no-padding">
            <div class="wpb_column vc_column_container vc_col-sm-12">
              <div class="vc_column-inner ">
                <div class="wpb_wrapper">
                  <div class="books-search">
                    <div class="container">
                      <form class="" method="get" action="http://midiyaweb.com/demo/bookie/">
                        <div class="row">
                          <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                              <input name="s" value="" type="text" class="form-control" id="keyword"
                                     placeholder="عنوان کتاب">
                            </div>
                          </div>

                          <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                              <select name='product_cat' id='product_cat' class='form-control'>
                                <option value='0'>دسته بندی کتاب</option>
                                <?
                                foreach ($categorys->result() as $categorys) {
                                  echo "<option class='level-0' value=''>$categorys->catname</option>";

                                }
                                ?>
                              </select>
                              <i class='select-arrow fa fa-angle-down'></i>
                            </div>
                          </div>

                          <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                              <select name='book_author' id='book_author' class='form-control'>
                                <option value='0'>نویسنده کتاب</option>
                                <?
                                foreach ($authors->result() as $authors) {
                                  echo "<option class='level-0' value='$authors->author_name'>$authors->author_name</option>";

                                }
                                ?>
                              </select>
                              <i class='select-arrow fa fa-angle-down'></i>
                            </div>
                          </div>
                          <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                              <input type="hidden" name="post_type" value="product"/>
                              <button type="submit" class="btn btn-primary btn-block">
                                <i class="simple-icon-magnifier"></i> &nbsp;پیدا کردن کتاب
                              </button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="vc_row-full-width vc_clearfix"></div>
          <div class="vc_row wpb_row vc_row-fluid vc_custom_1453085217674 vc_row-has-fill">
            <div class="wpb_column vc_column_container vc_col-sm-12">
              <div class="vc_column-inner ">
                <div class="wpb_wrapper">
                  <div class="toko-divider text-center line-no icon-hide">
                    <div class="divider-inner" style="background-color: #edf3f4">
                      <h3 class="toko-section-title">کتاب های محبوب</h3>
                    </div>
                  </div>
                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
                  <script>
                    getdata(1);
                    function getdata(a) {
                      $.ajax({
                        url: "http://localhost/eshop/GetData/index/" + a, success: function (result) {
                          $("#toko-carousel-343").html(result);
                        }
                      });
                    }
                  </script>
                  <div class="toko-woocommerce woocommerce columns-4 toko-no-carousel clearfix">
                    <ul class="products " id="toko-carousel-343">
                      <!-------------------------------------------------//-->
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="vc_row-full-width vc_clearfix"></div>
          <div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1453113651999 vc_row-has-fill">
            <div>
              <?
              $SpecialBooks = $this->db->query("SELECT category.catname,bookz.bookname, author.author_name, bookz.Description FROM author INNER JOIN bookz ON bookz.author = author.author_id INNER JOIN category ON bookz.category = category.catid WHERE bookz.specialbook = 1 ORDER BY book_id DESC");
              foreach ($SpecialBooks->result() as $SpecialBooks) {
                ?>
                <div class="wpb_column vc_column_container vc_col-sm-8" style="height:100px">
                  <div class="vc_column-inner vc_custom_1453112775660">
                    <div class="wpb_wrapper">
                      <div class="toko-featured-book style-2">
                        <div class="row">
                          <div class="row-md-height">
                            <div class="col-md-6 col-sm-6 col-md-height col-md-middle">
                              <div class="inside">
                                <p class="book-label">کتاب های ویژه</p>
                                <h2 class="book-title"><?=$SpecialBooks->bookname?></h2>
                                <p class="book-author-name"><?=$SpecialBooks->author_name?></p>
                              </div>
                              <div class="inside inside-book-description">
                                <p style="text-align: justify;text-justify: inter-word;"><?=$SpecialBooks->Description?></p>
                              </div>
                              <p class="book-button-wrap">
                                <a class="book-button btn btn-primary" href="<?= 'Book/focus/' . str_replace(' ', '-',$row->bookname);?>">جزئیات بیشتر</a>
                              </p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-md-height col-md-middle">
                              <div class="inside inside-book-cover">
                                <img class="book-image" width="339" height="480"
                                     src="assets/upload/<?= str_replace(' ', '-', urldecode($row->publishers . '-' . $row->author_name . '-' . $row->bookname)) . ".jpg" ?>">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      </div>
                  </div>
                </div>
                <div class="wpb_column vc_column_container vc_col-sm-4">
                  <div class="vc_column-inner ">
                    <div class="wpb_wrapper">
                      <div class="toko-featured-book-category style-2">
                        <div class="inside">
                          <img class="book-image" width="339" height="480" src="assets/upload/<?= str_replace(' ', '-', urldecode($row->publishers . '-' . $row->author_name . '-' . $row->bookname)) . "-backend.jpg" ?>">
                          <div class="inside-detail">
                            <span class="book-badge" style="background-color:#27c8ea;color:#ffffff;">دسته بندی ویژه</span>
                            <h2 class="book-title"> یک پیشنهاد خوب برای شما اگر بدنبال مطالعه در زمینه های <?= $SpecialBooks->catname;?> هستید </h2>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <? } ?>
            </div>
          </div>

          <div class="vc_row-full-width vc_clearfix"></div>
          <div class="vc_row wpb_row vc_row-fluid vc_custom_1453091031979 vc_row-has-fill">
            <div class="wpb_column vc_column_container vc_col-sm-12">
              <div class="vc_column-inner ">
                <div class="wpb_wrapper">
                  <div class="toko-cta text-center">
<!--                    <h2 class="toko-cta-title">مرور کتابخانه کامل ما</h2>-->
<!--                    <a href="#" class="toko-cta-link">مرور مجموعه</a>-->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="vc_row-full-width vc_clearfix"></div>
          <div class="vc_row wpb_row vc_row-fluid vc_custom_1453092599145 vc_row-has-fill">
            <div class="wpb_column vc_column_container vc_col-sm-4">
              <div class="vc_column-inner ">
                <div class="wpb_wrapper">
                  <div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-center">
                    <div class="vc_icon_element-inner vc_icon_element-color-custom vc_icon_element-size-xl vc_icon_element-style- vc_icon_element-background-color-grey">
                      <span class="vc_icon_element-icon entypo-icon entypo-icon-book-open" style="color:#27c8ea !important"></span></div>
                  </div>
                  <h2 style="font-size: 18px;text-align: center;font-family:Montserrat;font-weight:400;font-style:normal" class="vc_custom_heading">کتاب های مختلف</h2>
                  <div class="wpb_text_column wpb_content_element ">
                    <div class="wpb_wrapper">
                      <p style="text-align: center;">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و بااستفاده از طراحان گرافیک است.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="wpb_column vc_column_container vc_col-sm-4">
              <div class="vc_column-inner ">
                <div class="wpb_wrapper">
                  <div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-center">
                    <div
                      class="vc_icon_element-inner vc_icon_element-color-custom vc_icon_element-size-xl vc_icon_element-style- vc_icon_element-background-color-grey">
                      <span class="vc_icon_element-icon entypo-icon entypo-icon-pencil"
                            style="color:#86e154 !important"></span></div>
                  </div>
                  <h2
                    style="font-size: 18px;text-align: center;font-family:Montserrat;font-weight:400;font-style:normal"
                    class="vc_custom_heading">هزاران نویسنده</h2>

                  <div class="wpb_text_column wpb_content_element ">
                    <div class="wpb_wrapper">
                      <p style="text-align: center;"> لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                        استفاده از طراحان گرافیک است.</p>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="wpb_column vc_column_container vc_col-sm-4">
              <div class="vc_column-inner ">
                <div class="wpb_wrapper">
                  <div
                    class="vc_icon_element vc_icon_element-outer vc_icon_element-align-center">
                    <div
                      class="vc_icon_element-inner vc_icon_element-color-custom vc_icon_element-size-xl vc_icon_element-style- vc_icon_element-background-color-grey">
                      <span class="vc_icon_element-icon entypo-icon entypo-icon-bookmarks"
                            style="color:#e1dc54 !important"></span></div>
                  </div>
                  <h2
                    style="font-size: 18px;text-align: center;font-family:Montserrat;font-weight:400;font-style:normal"
                    class="vc_custom_heading">نشانه گذاری آسان</h2>

                  <div class="wpb_text_column wpb_content_element ">
                    <div class="wpb_wrapper">
                      <p style="text-align: center;">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و
                        بااستفاده از طراحان گرافیک است.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="vc_row-full-width vc_clearfix"></div>
          <div class="vc_row wpb_row vc_row-fluid vc_custom_1453093155486 vc_row-has-fill">
            <div class="wpb_column vc_column_container vc_col-sm-12">
              <div class="vc_column-inner ">
                <div class="wpb_wrapper">
                  <div class="toko-divider text-center line-no icon-hide">
                    <div class="divider-inner" style="background-color: #edf3f4">
                      <h3 class="toko-section-title">کتاب های پر بازدید</h3>
                    </div>
                  </div>
                  <div class="toko-woocommerce woocommerce columns-4 toko-no-carousel clearfix">
                    <ul class="products " id="toko-carousel-197">
                      <?
                      $row = $this->db->query("SELECT author.author_name, author.about ,bookz.* FROM author INNER JOIN bookz  ORDER BY `rate` DESC LIMIT 4");
                      foreach ($row->result() as $row) {
                        if ($row->discount >= 1) {
                          ?>
                          <li
                            class='post-70 product type-product status-publish has-post-thumbnail book_author-atkia product_cat-science product_tag-money product_tag-novel product_tag-culture  instock sale featured shipping-taxable purchasable product-type-simple'>
                            <div class='product-inner'>
                              <a href='' class='woocommerce-LoopProduct-link'>
                                  <span class="onsale">تخفیف!</span>
                                  <img
                                    src="assets/upload/<?= str_replace(' ', '-', urldecode($row->publishers . '-' . $row->author_name . '-' . $row->bookname)) . ".jpg" ?>"
                                    class="attachment-shop_catalog size-shop_catalog wp-post-image"
                                    alt="<?= $row->author_name.'-'.$row->bookname ?>" title="<?= $row->author_name.'-'.$row->bookname ?>"
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
                                    <a href="<?= 'Book/focus/' . str_replace(' ', '-',$row->bookname) ?>"
                                       class="button product-button">جزییات</a><a rel="nofollow"
                                                                                  href='http://systemcode.ir/Hadi-Abedzadeh/Payment/Request/<?= $row->isbn ?>'
                                                                                  class="button product_type_simple add_to_cart_button ajax_add_to_cart">خرید</a>
                                  </div>
                                </div>
                            </div>
                          </li>
                        <? } else {
                          ?>
                          <li
                            class='post-70 product type-product status-publish has-post-thumbnail book_author-atkia product_cat-science product_tag-money product_tag-novel product_tag-culture  instock sale featured shipping-taxable purchasable product-type-simple'>
                            <div class='product-inner'>
                                <img
                                  src="assets/upload/<?= str_replace(' ', '-', urldecode($row->publishers . '-' . $row->author_name . '-' . $row->bookname)) . ".jpg" ?>"
                                  class="attachment-shop_catalog size-shop_catalog wp-post-image"
                                  alt="<?= $row->author_name.'-'.$row->bookname?>" title="<?= $row->author_name.'-'.$row->bookname ?>"
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
                                  <a href="<?= 'Book/focus/' . str_replace(' ', '-',$row->bookname); ?>"
                                     class="button product-button">جزییات</a><a rel="nofollow"
                                                                                href='http://systemcode.ir/Hadi-Abedzadeh/Payment/Request/<?= $row->isbn ?>'
                                                                                class="button product_type_simple add_to_cart_button ajax_add_to_cart">خرید</a>
                                </div>
                              </div>
                            </div>
                          </li>
                          <?
                        }
                      } ?>


                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
<!--          <div class="vc_row-full-width vc_clearfix"></div>-->
<!--          <div class="vc_row wpb_row vc_row-fluid vc_custom_1453098699522 vc_row-has-fill">-->
<!--            <h3 class="toko-section-title">حراجی ها</h3>-->
<!---->
<!--            <div class="wpb_column vc_column_container vc_col-sm-4">-->
<!---->
<!--              <div class="vc_column-inner ">-->
<!--                <div class="wpb_wrapper">-->
<!--                  <div class="toko-featured-book-category style-1">-->
<!--                    <div class="inside">-->
<!--                      <img class="book-image" width="339" height="480"-->
<!--                           src="http://midiyaweb.com/demo/bookie/wp-content/uploads/2011/05/image1.jpg">-->
<!---->
<!--                      <div class="inside-detail">-->
<!--                        <span class="book-badge" style="background-color:#27c8ea;color:#ffffff;">50% تخفیف</span>-->
<!---->
<!--                        <h2 class="book-title">کتاب های گردشگری</h2>-->
<!---->
<!--                        <p class="book-button-wrap">-->
<!--                          <a class="book-button btn btn-primary" href="#">من این کارت رو میخوام</a>-->
<!--                        </p>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--            <div class="wpb_column vc_column_container vc_col-sm-4">-->
<!--              <div class="vc_column-inner ">-->
<!--                <div class="wpb_wrapper">-->
<!--                  <div class="toko-featured-book-category style-1">-->
<!--                    <div class="inside">-->
<!--                      <img class="book-image" width="339" height="480"-->
<!--                           src="http://midiyaweb.com/demo/bookie/wp-content/uploads/2011/05/image2.jpg">-->
<!---->
<!--                      <div class="inside-detail">-->
<!--                        <span class="book-badge" style="background-color:#7d4dde;color:#ffffff;">70% تخفیف</span>-->
<!---->
<!--                        <h2 class="book-title">کتاب آشپزی</h2>-->
<!---->
<!--                        <p class="book-button-wrap">-->
<!--                          <a class="book-button btn btn-primary" href="#">من این کتاب رو میخوام</a>-->
<!--                        </p>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--            <div class="wpb_column vc_column_container vc_col-sm-4">-->
<!--              <div class="vc_column-inner ">-->
<!--                <div class="wpb_wrapper">-->
<!--                  <div class="toko-featured-book-category style-1">-->
<!--                    <div class="inside">-->
<!---->
<!--                      <img class="book-image" width="339" height="480"-->
<!--                           src="http://midiyaweb.com/demo/bookie/wp-content/uploads/2011/05/image3.jpg">-->
<!---->
<!--                      <div class="inside-detail">-->
<!--                        <span class="book-badge" style="background-color:#dc4dde;color:#ffffff;">70 % تخفیف</span>-->
<!---->
<!--                        <h2 class="book-title">کتاب های طراحی</h2>-->
<!---->
<!---->
<!--                        <p class="book-button-wrap">-->
<!--                          <a class="book-button btn btn-primary" href="#">من این کتاب رو میخوام</a>-->
<!--                        </p>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->

<!--          <div class="vc_row-full-width vc_clearfix"></div>-->
<!--          <div data-vc-full-width="true" data-vc-full-width-init="false"-->
<!--               class="vc_row wpb_row vc_row-fluid vc_custom_1453099386743 vc_row-has-fill">-->
<!--            <div class="wpb_column vc_column_container vc_col-sm-12">-->
<!--              <div class="vc_column-inner ">-->
<!--                <div class="wpb_wrapper">-->
<!--                  <div-->
<!--                    class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_100 vc_sep_dashed vc_sep_pos_align_center vc_separator_no_text vc_sep_color_grey">-->
<!--                    <span class="vc_sep_holder vc_sep_holder_l"><span class="vc_sep_line"></span></span><span-->
<!--                      class="vc_sep_holder vc_sep_holder_r"><span class="vc_sep_line"></span></span>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="vc_row-full-width vc_clearfix"></div>-->
<!--          <div class="vc_row wpb_row vc_row-fluid vc_custom_1453099526859 vc_row-has-fill">-->
<!--            <div class="wpb_column vc_column_container vc_col-sm-12">-->
<!--              <div class="vc_column-inner ">-->
<!--                <div class="wpb_wrapper">-->
<!--                  <div class="wpb_single_image wpb_content_element vc_align_center">-->
<!---->
<!--                      <a href="#" class="vc_single_image-wrapper vc_box_border_grey">-->
<!--                        <img width="1170" height="140" src="http://midiyaweb.com/demo/bookie/wp-content/uploads/2011/05/banner-bottom.jpg" class="vc_single_image-img attachment-full" alt="banner-bottom" sizes="(max-width: 1170px) 100vw, 1170px"/>-->
<!--                      </a>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="vc_row-full-width vc_clearfix"></div>-->

        </div>

      </article>


    </div>
  </div>


</div>