<div class="btn btn-default">
    <i class="fa fa-search"></i>
</div>
<form role="search" class="searchform" action="<?php echo esc_url( home_url() ); ?>" id="searchform" method="get">
    <div class="input-group">
        <input type="search" id="s" name="s" class="form-control" placeholder="<?php _e('Search...', 'pryaniktheme') ?>">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="fa fa-angle-right"></i></button>
        </span>
    </div>
</form>