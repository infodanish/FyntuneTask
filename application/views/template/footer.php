<!--$(window).on('load', function() {
        $('#exampleModal').modal('show');

    }); -->

<!-- tap to top start -->

<div class="tap-top">
    <div><i class="fa fa-angle-double-up"></i></div>
</div>
<!-- tap to top end -->


     <!-- latest jquery-->
     <!-- <script src="<?=base_url()?>assets/js/jquery-3.3.1.min.js"></script> -->

<!-- menu js-->
<script src="<?=base_url()?>assets/js/menu.js"></script>

<!-- lazyload js-->
<script src="<?=base_url()?>assets/js/lazysizes.min.js"></script>

<!-- popper js-->
<script src="<?=base_url()?>assets/js/popper.min.js"></script>

<!-- slick js-->
<script src="<?=base_url()?>assets/js/slick.js"></script>

<!-- Bootstrap js-->
<script src="<?=base_url()?>assets/js/bootstrap.js"></script>

<!-- Bootstrap Notification js-->
<script src="<?=base_url()?>assets/js/bootstrap-notify.min.js"></script>

<script src="<?=base_url()?>assets/js/jquery.nice-select.min.js"></script>


<script src="<?=base_url()?>assets/js/script.js"></script>
   <!-- <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> -->
	  


<script>
    function openSearch() {
        document.getElementById("search-overlay").style.display = "block";
    }

    function closeSearch() {
        document.getElementById("search-overlay").style.display = "none";
    }
 
    $("#exampleInputPassword1").keyup(function(){
        var a=$("#exampleInputPassword1").val();
        // alert(a);
        $.ajax({
            url: '<?php echo base_url('home/search'); ?>',
            type: 'POST',
            data: {
                'term': a
            },
            dataType: 'json',
            success: function(data) {
                $('#search-product').html(data.data);
            }
        });
      });
</script>
<!-- Spacer div end -->
<!-- footer start -->
<footer class="footer-light">    
    
    <div class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-6 col-sm-12">
                    <div class="footer-end">
                        <p><i class="fa fa-copyright" aria-hidden="true"></i> 2020 &copy; Online Shopping</p>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-sm-12">
                    <div class="payment-card-bottom">
                        <ul>
                            <li>
                                Powered by <a href="#" target="_blank">Danish Akhtar</a>
                            </li>                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer end -->