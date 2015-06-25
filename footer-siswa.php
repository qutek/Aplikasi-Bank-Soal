</section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/bootstrap.min.js"></script>
    
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>
    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <?php if(@$notif){ 
      $kelas = (isset($_SESSION['kelas'])) ? get_kelas_name($_SESSION['kelas']) : '';
      ?>
    <script type="text/javascript">
        $(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Selamat Datang <br><?php echo $_SESSION['nama']; ?>!',
            // (string | mandatory) the text inside the notification
            text: 'Silahkan pilih mata pelajaran dari daftar mata pelajaran untuk kelas <?php echo $kelas; ?> berikut.',
            // (string | optional) the image to display on the left
            image: 'assets/img/ui-sam.jpg',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
        });
    </script>
    <?php } ?>

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