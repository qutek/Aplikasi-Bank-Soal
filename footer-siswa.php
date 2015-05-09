<!--main content end-->
<!--footer start-->
<!-- <footer class="site-footer">
  <div class="text-center">
    Aplikasi Bank Soal
      <a href="#" class="go-top">
          <i class="fa fa-angle-up"></i>
      </a>
  </div>
</footer> -->
<!--footer end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
    $('.list-primary').click(function(){
        $(this).find('.jawaban').attr('checked', 'checked');
        $(this).closest('.task-list').find('.badge-dipilih').hide();
        $(this).find('.badge-dipilih').show();
    });
    // $('.jawaban').each(function( index, elem ) {
    //   if($(elem).attr("checked", "checked")){
    //     alert('ok');
    //   }
    // });
</script>



</body>
</html>