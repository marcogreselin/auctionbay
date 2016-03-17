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
        defaultDate: +1,
        dateFormat: "yy-mm-dd",
        minDate: new Date(new Date().getTime() + 24 * 60 * 60 * 1000),
        maxDate: new Date(new Date().getTime() + 24 * 60 * 60 * 1000*60)
      }).prev('.btn').on('click', function (e) {
        e && e.preventDefault();
        $(datepickerSelector).focus();
      });

      // Aligning datepicker with the prepend button
      $(datepickerSelector).datepicker('widget').css({'margin-left': -$(datepickerSelector).prev('.btn').outerWidth()});
    </script>

<!-- Select-two javascript for getting the select to work -->
    <script type="text/javascript">
    $('select').select2();
    </script>


    <!-- Counting down the number of characters left in the comment textarea -->
    <script type="text/javascript">
        $(document).ready(function () {
            var maxText = 500;
            $('#textarea-characters-remaining').html(maxText + ' characters remaining');

            $('#textarea-comment').keyup(function () {
                var textLength = $('#textarea-comment').val().length;
                var remainingText = maxText - textLength;

                $('#textarea-characters-remaining').html(remainingText + ' characters remaining');
            });
        });
    </script>

  </body>
</html>