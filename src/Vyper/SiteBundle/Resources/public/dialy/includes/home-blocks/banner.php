<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    $DF_builder = new DF_home_builder; 
    //get block data
    $data = $DF_builder->get_data(); 
    //extract array data
    extract($data[0]); 


?>
<?php if($code) { ?>
    <div class="clear"></div>
    <!-- Banner space -->
    <div class="banner-space">
        <?php echo $code;?>
	</div>
<?php } ?>