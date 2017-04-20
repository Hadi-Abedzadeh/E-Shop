<style>
  .postList {
    width: 100%;
    min-height: 130px;
    background: rgba(111, 111, 111, 0.4);
    direction: rtl;
    float: right;
    box-shadow: 2px 1px 7px;
    padding: 10px;
    margin:10px;
    font-size:120%;
  }
</style>
<?
$query = $this->db->query("SELECT author.author_name, author.about ,bookz.* FROM author INNER JOIN bookz");

?>
<meta charset="utf-8">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script>
  getdata(1);
  function getdata(a) {
    $.ajax({
      url: "http://localhost/eshop/GetData/adminPageData/" + a, success: function (result) {
        $("#posts").html(result);
      }
    });
  }



</script>

<div class="container" id="posts">


</div>

