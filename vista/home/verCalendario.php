
<style>

.opt-ctr-images
{
    justify-content: center;
    align-items: center;
    display: flex;
}
#gallery_current_img
{
    user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    border: 2px solid #ccc;
    border-radius: 20px;
    box-shadow: 1px 1px 3px lightblue;
}
</style>




<div class="row">
    <div class="col-1 opt-ctr-images p-0">
        <button class="btn btn-outline-dark" id='gallery_prev_img'><i class="fas fa-angle-left"></i></button>
    </div>
    <div class="col-10 p-0">
    <img id='gallery_current_img' src="<?php echo base_url().'lib/img/home_gallery/'.date('n').'.png';?>" jscurrent=<?php echo date('n')?> width="100%" alt="">

    </div>
    <div class="col-1 opt-ctr-images p-0">
        <button class="btn btn-outline-dark" id='gallery_next_img'><i class="fas fa-angle-right"></i></button>
    </div>
</div>

<script>
    $(document).ready(function(){
       // $('#gallery_prev_img').hide();
        var dirimg = "<?php echo base_url().'lib/img/home_gallery/';?>";
        $('#gallery_next_img').click(function(){
            var current = parseInt($('#gallery_current_img').attr('jscurrent'));
            current = current + 1;
            $('#gallery_current_img').attr('src',dirimg+current+".png");
            $('#gallery_current_img').attr('jscurrent',current);
            if(current == 12)
            {
                $(this).hide();
            }
            if(current == 2)
            {
                $('#gallery_prev_img').show();
            }
        });


        $('#gallery_prev_img').click(function(){
            var current = parseInt($('#gallery_current_img').attr('jscurrent'));
            current = current - 1;
            $('#gallery_current_img').attr('src',dirimg+current+".png");
            $('#gallery_current_img').attr('jscurrent',current);
            if(current == 1)
            {
                $(this).hide();
            }
            if(current == 11)
            {
                $('#gallery_next_img').show();
            }
        });

       
    });
</script>