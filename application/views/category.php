<?
$cat = $this->db->query("SELECT catname FROM category");
$disCat = $this->db->query("SELECT author.author_name, bookz.* FROM author INNER JOIN bookz where discount >=1  order by rate DESC LIMIT 4");
$disRate = $this->db->query("SELECT author.author_name, bookz.* FROM author INNER JOIN bookz  order by rate DESC LIMIT 4");

$authors = $this->db->query("SELECT author_name FROM author");
$categorys = $this->db->query("SELECT catname  FROM category");

?>
<body
  class="rtl archive tax-product_cat term-science term-29 woocommerce woocommerce-page header-large wpb-js-composer js-comp-ver-4.12.1 vc_responsive columns-3">

<div class="site-wrap">
  <section id="page-title" class="page-title">
    <div class="container">


      <h1>کتاب های: <?=$category;?></h1>

      <nav class="woocommerce-breadcrumb"><a href="<?= base_url(); ?>">خانه</a>&nbsp;&#47;&nbsp;<?=$category?></nav>
    </div>
  </section>

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
  <div class="main-content-container container">
    <div class="row">
      <div class="col-md-8">
        <div id="content" class="main-content-inner" role="main">
          <ul class="products">
            <?
            $query = $this->db->query("SELECT bookz.isbn, bookz.discount,bookz.price,bookz.publishers,category.catname,bookz.bookname, author.author_name, bookz.Description FROM author INNER JOIN bookz ON bookz.author = author.author_id INNER JOIN category ON bookz.category = category.catid WHERE category.catname = '$category' ORDER BY book_id DESC");
            foreach($query->result() as $row){
            if ($row->discount >= 1) {
              ?>

              <li class='post-70 product type-product status-publish has-post-thumbnail book_author-atkia product_cat-science product_tag-money product_tag-novel product_tag-culture  instock sale featured shipping-taxable purchasable product-type-simple'>
                <div class='product-inner'>
                  <a href='../focus/<?=$row->bookname?>'>
                      <span class="onsale">تخفیف!</span>
                      <img src="../../assets/upload/<?= str_replace(' ', '-', urldecode($row->publishers . '-' . $row->author_name . '-' . $row->bookname)) . ".jpg" ?>"
                        class="attachment-shop_catalog size-shop_catalog wp-post-image" alt="bookie18-416x568" title="bookie18-416x568">
                  </a>
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
                    <div class="woo-button-border"><a href="<?= '../focus/' . $row->bookname ?>"
                                                      class="button product-button">جزییات</a><a rel="nofollow"
                                                                                                 href='http://systemcode.ir/Hadi-Abedzadeh/Payment/Request/<?=$row->isbn?>'
                                                                                                 class="button product_type_simple add_to_cart_button ajax_add_to_cart">خرید</a>
                    </div>
                  </div>
                </div>
              </li>
<? }else{ ?>

              <li class='post-70 product type-product status-publish has-post-thumbnail book_author-atkia product_cat-science product_tag-money product_tag-novel product_tag-culture  instock sale featured shipping-taxable purchasable product-type-simple'>
                <div class='product-inner'>
                  <a href='../focus/<?=$row->bookname?>'>
                    <img src="../../assets/upload/<?= str_replace(' ', '-', urldecode($row->publishers . '-' . $row->author_name . '-' . $row->bookname)) . ".jpg" ?>"
                         class="attachment-shop_catalog size-shop_catalog wp-post-image" alt="bookie18-416x568" title="bookie18-416x568">
                  </a>
                  <div class="product-price-box clearfix">
                    <h3><?=$row->bookname?></h3><span
                      class="person-name vcard"><?=$row->author_name;?></span>
                      <span class="price">
                      <ins><span class="woocommerce-Price-amount amount"><?=$this->jdf->tr_num($row->price, 'fa')?>&nbsp;<span class="woocommerce-Price-currencySymbol">تومان</span></span></ins>
                      </span>
                  </div>

                  <div class="woo-button-wrapper">
                    <div class="woo-button-border"><a href="<?= '../focus/' . $row->bookname ?>"
                                                      class="button product-button">جزییات</a><a rel="nofollow"
                                                                                                 href='http://systemcode.ir/Hadi-Abedzadeh/Payment/Request/<?=$row->isbn?>'
                                                                                                 class="button product_type_simple add_to_cart_button ajax_add_to_cart">خرید</a>
                    </div>
                  </div>
                </div>
              </li>

            <?} }?>
          </ul>
        </div>
      </div>


      <div class="col-md-4">
        <aside id="sidebar" class="sidebar">
          <section id="woocommerce_product_categories-2" class="widget woocommerce widget_product_categories">
            <div class="widget-wrap widget-inside"><h3 class="widget-title">دسته های محصولات</h3>
              <ul class="product-categories">
                <?
                foreach($cat->result() as $catz) {?>
                <li class="cat-item cat-item-25 cat-parent"><a
                    href="<?= base_url() . 'category/' . $catz->catname ?>"><?=$catz->catname?></a>
                  <?}?>
              </ul>
              </li>


            </div>
          </section>

          <section id="woocommerce_products-3" class="widget woocommerce widget_products">
            <div class="widget-wrap widget-inside"><h3 class="widget-title">محصولات تخفیف</h3>
              <ul class="product_list_widget">
                <?
                foreach ($disCat->result() as $disCatz) { ?>
                  <li>
                    <a href="<?= base_url() . 'focus/' . $disCatz->bookname; ?>" title='<?= $disCatz->bookname ?>'>
                      <img width="180" height="180"
                           src="../../assets/upload/<?= str_replace(' ', '-', urldecode($disCatz->publishers . '-' . $disCatz->author_name . '-' . $disCatz->bookname)) . ".jpg" ?>"
                           class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" alt="bookie28-416x574"/>
                      <span class="product-title"><?=$disCatz->bookname?></span>
                    </a>
                    <? if ($disCatz->discount >= 1) { ?>
                      <del><span class="woocommerce-Price-amount amount"><?=$this->jdf->tr_num($disCatz->price, 'fa')?>
                          <span class="woocommerce-Price-currencySymbol">تومان</span></span></del>
                      <ins><span
                          class="woocommerce-Price-amount amount"><?=$this->jdf->tr_num($disCatz->price - ($disCatz->price * $disCatz->discount) / 100, 'fa');?>
                          <span class="woocommerce-Price-currencySymbol">تومان</span></span></ins>

                      <?
                    } else { ?>
                      <ins><span class="woocommerce-Price-amount amount"><?=$this->jdf->tr_num($disCatz->price, 'fa')?>
                          <span class="woocommerce-Price-currencySymbol">تومان</span></span></ins>
                      <?
                    }?>
                  </li>
                  <?
                }
                ?>
              </ul>
            </div>
          </section>


          <section id="woocommerce_top_rated_products-1" class="widget woocommerce widget_top_rated_products">
            <div class="widget-wrap widget-inside"><h3 class="widget-title">پرامتیاز ترین محصولات</h3>
              <ul class="product_list_widget">
                <?
                foreach ($disRate->result() as $inRate) {
                  ?>
                  <li>
                    <a href="" title="">
                      <img width="180" height="180"
                           src="../../assets/upload/<?= str_replace(' ', '-', urldecode($inRate->publishers . '-' . $inRate->author_name . '-' . $inRate->bookname)) . ".jpg" ?>"
                           class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" alt=""/>
                      <span class="product-title"><?=$inRate->bookname?></span>
                    </a>
                    <? if ($inRate->discount >= 1) { ?>
                      <del><span class="woocommerce-Price-amount amount"><?=$this->jdf->tr_num($inRate->price, 'fa')?>
                          <span class="woocommerce-Price-currencySymbol">تومان</span></span></del>
                      <ins><span
                          class="woocommerce-Price-amount amount"><?=$this->jdf->tr_num($inRate->price - ($inRate->price * $inRate->discount) / 100, 'fa');?>
                          <span class="woocommerce-Price-currencySymbol">تومان</span></span></ins>

                    <? } else { ?>
                      <ins><span class="woocommerce-Price-amount amount"><?=$this->jdf->tr_num($inRate->price, 'fa')?>
                          <span class="woocommerce-Price-currencySymbol">تومان</span></span></ins>
                    <? }?>                </li>
                <? }?>
              </ul>
            </div>
          </section>
          <section id="woocommerce_product_tag_cloud-1" class="widget woocommerce widget_product_tag_cloud">
            <div class="widget-wrap widget-inside">
              <h3 class="widget-title">برچسب های محصولات</h3>

              <div class="tagcloud">
                <?
                foreach ($cat->result() as $cat) {
                  ?>
                  <a href='<?= $cat->catname ?>' class='tag-link-21 tag-link-position-1' title='<?= $cat->catname ?>'
                     style='font-size: 22pt;'><?=$cat->catname?></a>
                  <?
                }
                ?>
              </div>
            </div>
          </section>
        </aside>
      </div>
    </div>

  </div>