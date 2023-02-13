<div id="header" class="header navbar-default">
    <div class="navbar-header">
        <a href="<?php echo e(base_url()); ?>" class="navbar-brand"><i class="fas fa-briefcase-medical"></i> <b><?php echo e($application_copyright); ?> | <?php echo e($application_name); ?> <?php echo e($version); ?> | <i><b small color='#b9ddca'>   <?php echo e($covid); ?> </b></i> |</b> <?php echo e($application_long_name); ?></a>
        <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown navbar-user">
            <a href="<?php echo e(base_url('auth/logout')); ?>" class="dropdown-toggle" data-toggle="">
                <i class="fa fa-power-off text-center text-danger f-s-14"></i>
            </a>
        </li>
    </ul>
</div>