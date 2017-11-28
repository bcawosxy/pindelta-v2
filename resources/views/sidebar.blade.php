<div class="sidebar col-md-3 col-sm-5">
    <ul class="list-group margin-bottom-25 sidebar-menu">
        <?php
        foreach ( $data['sidebar'] as $k0 => $v0 ) {
            $active1 = isset($v0['active']) ? 'active' : null;
            $display = isset($v0['active']) ? 'display:block' : 'display:none';
            echo '<li class="list-group-item clearfix '.$active1.' ">
                                            <a href="'.url()->route('pindelta::categoryarea', ['id'=>$v0['cg_id']]).'"><i class="fa fa-angle-right"></i>'.$v0['cg_name'].'</a>
                                            <ul class="dropdown-menu" style="'.$display.'">';
                if(isset($v0['item'])) {
                    foreach ( $v0['item'] as $k1 => $v1) {
                        $active2 = isset($v1['active']) ? 'active' : null;
                        echo '<li class="'.$active2.'"><a href="'.url()->route('pindelta::category', ['cg_id'=>$v0['cg_id'] , 'id'=>$v1['c_id']]).'"><i class="fa fa-caret-right"></i>'.$v1['c_name'].'</a></li>';
                    }
                }
            echo '</ul></li>';
        }
        ?>
    </ul>
</div>