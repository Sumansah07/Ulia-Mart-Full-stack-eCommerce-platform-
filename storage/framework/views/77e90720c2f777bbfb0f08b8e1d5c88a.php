<?php
$supportRoutes = ['support.index', 'support.category.index', 'support.priority.index'];

?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['support.index'])): ?>
<li class="side-nav-item nav-item <?php echo e(areActiveRoutes($supportRoutes, 'tt-menu-item-active')); ?>">
    <a data-bs-toggle="collapse" href="#support-ticket"
        aria-expanded="<?php echo e(areActiveRoutes($supportRoutes, 'true')); ?>" aria-controls="support-ticket"
        class="side-nav-link tt-menu-toggle">
        <span class="tt-nav-link-icon"><i data-feather="life-buoy"></i></span>
        <span class="tt-nav-link-text"><?php echo e(localize('Support Ticket')); ?></span>
    </a>
    <div class="collapse <?php echo e(areActiveRoutes($supportRoutes, 'show')); ?>" id="support-ticket">
        <ul class="side-nav-second-level">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('support.category.index')): ?>
            <li class="<?php echo e(areActiveRoutes(['support.category.index'], 'tt-menu-item-active')); ?>">
                <a href="<?php echo e(route('support.category.index')); ?>"><?php echo e(localize('Category')); ?></a>
            </li>
            <?php endif; ?>           
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('support.priority.index')): ?>
            <li class="<?php echo e(areActiveRoutes(['support.priority.index'], 'tt-menu-item-active')); ?>">
                <a href="<?php echo e(route('support.priority.index')); ?>"><?php echo e(localize('Priority')); ?></a>
            </li>
            <?php endif; ?>           
            
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('support.ticket.index')): ?>
                <li class="<?php echo e(areActiveRoutes(['support.ticket.index'], 'tt-menu-item-active')); ?>">
                    <a href="<?php echo e(route('support.ticket.index')); ?>"><?php echo e(localize('Tickets')); ?></a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</li>
<?php endif; ?><?php /**PATH D:\Suman-ogani\uliaa.infiniteitsolutionsnepal.com\Modules/Support\Resources/views/sidebar/support_sidebar.blade.php ENDPATH**/ ?>