    <!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/vendor/video.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/flat-ui-pro.js"></script>
    <!-- Load word counter -->
    <script src="js/jquery.simplyCountable.js"></script>
    <!-- This is for the smooth scrolling. See http://stackoverflow.com/questions/7717527/jquery-smooth-scrolling-when-clicking-an-anchor-link -->
    <script type="text/javascript">
      $('a').click(function(){
          $('html, body').animate({
              scrollTop: $('[name="' + $.attr(this, 'href').substr(1) + '"]').offset().top
          }, 500);
          return false;
      });

      // jQuery UI Datepicker JS init used create_auction.php
      var datepickerSelector = '#datepicker-01';
      $(datepickerSelector).datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        dateFormat: "yy-mm-dd",
        yearRange: '-0:+0'
      }).prev('.btn').on('click', function (e) {
        e && e.preventDefault();
        $(datepickerSelector).focus();
      });

      // Now let's align datepicker with the prepend button
      $(datepickerSelector).datepicker('widget').css({'margin-left': -$(datepickerSelector).prev('.btn').outerWidth()});
    </script>


  </body>
</html>