
$(document).ready(function(){

    $('.selectpicker').selectpicker();    

    val = $('.selectpicker option:selected').val();
    $('.font-icon-detail span:first-child').css( "font-size", val + "px" );
    $('#content').removeClass().addClass("size"+val);

    $('.selectpicker').change(function(){
        val = $('.selectpicker option:selected').val();
        $('.font-icon-detail span:first-child').css( "font-size", val + "px" );
        $('#content').removeClass().addClass("size"+val);
    });

    $('#chkbx-1').change(function() {
       if($(this).is(":checked")) {
            $('.font-icon-code').addClass('show');
          return;
       }
        $('.font-icon-code').removeClass('show');
    });

    $('#s1').change(function() {
       if($(this).is(":checked")) {
          $('body').addClass("dark");
          return;
       }
      $('body').removeClass("dark");
    });

    $('#nav').affix({
        offset: { top: $('#nav').offset().top },
    });

    $('#nav').on('affix.bs.affix', function () {
        $('#font_options_bar').height($("#nav").height());
    });

    $('#nav').on('affixed-top.bs.affix', function () {
        $('#font_options_bar').height('auto');
    });

    $(".code-value, .unicode, .unicode-text, .font-icon-name").click(function(){
      $(this).select();
    });

    $('.font-icon-detail').on("click", function(){
      $(this).find('.font-icon-name').select();
    });


    searchShow.onchange = function(){
      if(this.checked) {
        setTimeout(function(){
          search.focus()  
        },50)
      }
    }

    search.onchange = function(){
      doSearch(this);
    }
    search.onkeyup = function(e){
      if (e.keyCode == 27) {
        this.value = "";
        searchShow.checked = false;
      } else {
      }
      doSearch(this);
    }


}) // Ready


$(window).scroll(function() {
  var opacityValue;
  opacityValue = 1 - $(window).scrollTop() / 315;
  return $("#showcase hgroup").css("opacity", opacityValue);
});

var search = document.querySelector('#search');
var searchShow = document.querySelector('#search-show');
var emptySearch = document.querySelector('#search-empty');


function doSearch(filter){
    var filter = filter.value;
    var allIcons = document.getElementById('all-icons');
    var all = allIcons.querySelectorAll('.font-icon-list');
    var contains = allIcons.querySelectorAll('.font-icon-name[value*="' + filter + '"]');

    if(filter != "") {
      for (var i = 0; i < all.length; i++) {
        all[i].style.display = "none";
      };

      for (var i = 0; i < contains.length; i++) {
        contains[i].parentElement.parentElement.style.display = "block";
      };

      if(contains.length == 0){
        emptySearch.style.display = "block";
        emptySearch.querySelector('strong').innerHTML = search.value;
      } else {
        emptySearch.style.display = "none";
      }
    } else {
      for (var i = 0; i < all.length; i++) {
        all[i].style.display = "block";
      };
      emptySearch.style.display = "none";
    }


}






