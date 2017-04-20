<?
  error_reporting(0);
$query = $this->db->query("SELECT author.author_name, author.about ,bookz.* FROM author INNER JOIN bookz ON author.author_id = bookz.author WHERE bookz.bookname = '$bookname'");

$row = $query->row();
$DBdate = $row->date;
$DBdate = explode('-',$DBdate);
$isbn = $row->isbn;

$catList = $this->db->query("SELECT category.catname FROM category INNER JOIN bookz ON bookz.category = category.catid WHERE bookname= '$bookname'");
$catList = $catList->row(0);
$this->db->query("UPDATE bookz SET rate = rate+1 WHERE isbn = '$isbn';");


$authors = $this->db->query("SELECT author_name FROM author");
$categorys = $this->db->query("SELECT catname  FROM category");
?>
<body class="rtl single single-product postid-70 woocommerce woocommerce-page header-large wpb-js-composer js-comp-ver-4.12.1 vc_responsive columns-4">

<div class="site-wrap">
  <section id="page-title" class="page-title"  >
    <div class="container">



      <h2>توضیحات کتاب: <?=$bookname?></h2>


      <nav class="woocommerce-breadcrumb"><a href="<?=base_url();?>">خانه</a>&nbsp;&#47;&nbsp;<a href="<?=base_url().'Book/category/'.$catList->catname?>"><?=$catList->catname?></a>&nbsp;&#47;&nbsp;<?=$bookname?></nav>
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
                <i class="simple-icon-magnifier"></i> &nbsp;پیدا کردن کتاب</button>
            </div>
          </div>

        </div>
      </form>
    </div>
  </div>
  <div class="main-content-container container">

    <div id="content" class="main-content-inner" role="main">



      <div itemscope itemtype="http://schema.org/Product" id="product-70" class="post-70 product type-product status-publish has-post-thumbnail book_author-atkia product_cat-science product_tag-money product_tag-novel product_tag-culture first instock sale featured shipping-taxable purchasable product-type-simple">
        <span class="onsale">تخفیف!</span>
        <div class="images">
            <img width="416" height="568" src="../../assets/upload/<?= str_replace(' ', '-', urldecode($row->publishers.'-'.$row->author_name.'-'.$row->bookname)).".jpg"?>" class="attachment-shop_single size-shop_single wp-post-image" alt="کتاب <?=$row->bookname?>, نویسنده <?=$row->author?>" title="کتاب <?=$row->bookname?>, نویسنده <?=$row->author?>" sizes="(max-width: 416px) 100vw, 416px" />
        </div>


        <div class="summary entry-summary">
          <h1 itemprop="name" class="product_title entry-title"><?=$bookname?></h1><div itemprop="description">
            <p style="text-align: justify;text-justify: inter-word;"><?=$this->jdf->tr_num($row->Description,'fa')?></p>
          </div>
          <div class="product-offer-box">
              <div itemprop="offers" itemscope>
              <p class="price">
                <? if($row->discount >= 1){?>
                <del><span class="woocommerce-Price-amount amount"><?=$this->jdf->tr_num($row->price,'fa')?>&nbsp;<span class="woocommerce-Price-currencySymbol">تومان</span></span></del>
                <? } ?>
                <ins><span class="woocommerce-Price-amount amount"><?=$this->jdf->tr_num($row->price-($row->price*$row->discount)/100,'fa')?>&nbsp;<span class="woocommerce-Price-currencySymbol">تومان</span></span></ins>
              </p>
              <meta itemprop="price" content="12" />
              <meta itemprop="priceCurrency" content="IRT" />
              <link itemprop="availability" href="http://schema.org/InStock" />
            </div>




            <form class="cart" method="post" enctype='multipart/form-data'>
              <div class="quantity">
                <input type="number" step="1" min="1" max="" name="quantity" value="1" title="تعداد" class="input-text qty text" size="4" pattern="[0-9]*" inputmode="numeric" />
              </div>
              <button type="submit" class="single_add_to_cart_button button alt">هم اکنون میخرم</button>

            </form>


          </div>
          <div class="product_meta">
            <span class="posted_in">دسته: <a href="<?=base_url().'Book/category/'.$catList->catname?>" rel="tag"><?=$catList->catname?></a></span>

          </div>


        </div>
        <!-- .summary -->


        <div class="section-book-details clearfix">
          <div class="row" >

            <div class="col-md-6">
              <th><h3>جزئیات کتاب</h3></th>

              <table class="table">

                <tbody>
                <tr class="info">
                  <td>صفحات</td>
                  <td class="text-center"><p><?=$this->jdf->tr_num((int)$row->pages,'fa')?></p></td>
                </tr>
                <tr>
                  <td>انتشارات</td>
                  <td class="text-center"><p><?=$row->publishers?></p></td>
                </tr>
                <tr class="success">
                  <td>زبان</td>
                  <td class="text-center"><p><?=$row->lang?></p></td>
                </tr>
                <tr class="danger">
                  <td>ISBN</td>
                  <td class="text-center"><p><?=$this->jdf->tr_num($row->isbn,'fa')?></p></td>
                </tr>

                <tr class="info">
                  <td>نسخه</td>
                  <td class="text-center"><p><?=$this->jdf->jdate($this->jdf->gregorian_to_jalali($DBdate[0],$DBdate[1],$DBdate[2],'/'))?></p></td>
                </tr>

                </tbody>
              </table>
            </div>

            <div class="col-md-6">
              <div class="book-authors">
                <h3>درباره نویسنده</h3>
                <h4><?=$row->author_name?></h4>
                <p style="text-align: justify;text-justify: inter-word;"><?=$row->about?></p>
              </div>
            </div>
          </div>
        </div>


      </div><!-- #product-70 -->




    </div>


  </div>
<!--  <div class="section-products-list section-products-list-upsells">-->
<!--    <div class="container">-->
<!---->
<!--      <div class="upsells products">-->
<!---->
<!--        <h2>همچنین ممکن است شما دوست داشته باشید&hellip;</h2>-->
<!---->
<!--        <ul class="products">-->
<!---->
<!--          --><?//
//          for($i=1;$i<=4;$i++){?>
<!--          <li class="post-31 product type-product status-publish has-post-thumbnail book_author-sarfaraz product_cat-inspiration product_cat-drama product_tag-novel product_tag-culture  instock shipping-taxable purchasable product-type-simple">-->
<!--            <div class="product-inner"><a href="" class="woocommerce-LoopProduct-link"><figure class="product-image-box"><img width="300" height="300" src="" class="attachment-shop_catalog size-shop_catalog wp-post-image" alt="bookie7-416x574" title="bookie7-416x574" srcset="http://midiyaweb.com/demo/bookie/wp-content/uploads/2013/06/bookie7-416x574-300x300.png 300w, http://midiyaweb.com/demo/bookie/wp-content/uploads/2013/06/bookie7-416x574-150x150.png 150w, http://midiyaweb.com/demo/bookie/wp-content/uploads/2013/06/bookie7-416x574-180x180.png 180w" sizes="(max-width: 300px) 100vw, 300px" /></figure><div class="product-price-box clearfix"><h3>محصول شماره 20</h3><span class="person-name vcard">جلال میرزایی</span>-->
<!--                  <span class="price"><span class="woocommerce-Price-amount amount">20.00&nbsp;<span class="woocommerce-Price-currencySymbol">تومان</span></span></span>-->
<!--                </div></a><div class="woo-button-wrapper"><div class="woo-button-border"><a href="" class="button product-button">جزییات</a><a rel="nofollow" href="" data-quantity="1" data-product_id="31" data-product_sku="" class="button product_type_simple add_to_cart_button ajax_add_to_cart">خرید</a></div></div></div></li>-->
<?//
//          }
//          ?>
<!---->
<!--        </ul>-->
<!---->
<!--      </div>-->
<!---->
<!--    </div>-->
<!--  </div>-->