<div class="sidebar col-md-3 col-sm-5">
    <ul class="list-group margin-bottom-25 sidebar-menu">
        {{--<li class="list-group-item clearfix dropdown active">--}}
            {{--<a href="javascript:void(0);" class="collapsed">--}}
                {{--<i class="fa fa-angle-right"></i>--}}
                {{--Mens--}}
            {{--</a>--}}
            {{--<ul class="dropdown-menu" style="display:block;">--}}
                {{--<li class="list-group-item dropdown clearfix active">--}}
                    {{--<a href="javascript:void(0);" class="collapsed"><i class="fa fa-angle-right"></i> Shoes </a>--}}
                    {{--<ul class="dropdown-menu" style="display:block;">--}}
                        {{--<li class="list-group-item dropdown clearfix">--}}
                            {{--<a href="javascript:void(0);"><i class="fa fa-angle-right"></i> Classic </a>--}}
                            {{--<ul class="dropdown-menu">--}}
                                {{--<li><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Classic 1</a></li>--}}
                                {{--<li><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Classic 2</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        {{--<li class="list-group-item dropdown clearfix active">--}}
                            {{--<a href="javascript:void(0);" class="collapsed"><i class="fa fa-angle-right"></i> Sport  </a>--}}
                            {{--<ul class="dropdown-menu" style="display:block;">--}}
                                {{--<li class="active"><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Sport 1</a></li>--}}
                                {{--<li><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Sport 2</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Trainers</a></li>--}}
                {{--<li><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Jeans</a></li>--}}
                {{--<li><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Chinos</a></li>--}}
                {{--<li><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> T-Shirts</a></li>--}}
            {{--</ul>--}}
        {{--</li>--}}
        <?php

        foreach ( $data['sidebar'] as $k0 => $v0 ) {

            $active1 = ($data['activeCategoryarea_id'] == $v0['categoryarea_id']) ? 'active' : null;
            $display = ($data['activeCategoryarea_id'] == $v0['categoryarea_id']) ? 'display:block' : 'display:none';
            echo '<li class="list-group-item clearfix '.$active1.' ">
                                            <a href="'.url()->route('pindelta::categoryarea', ['id'=>$v0['categoryarea_id']]).'"><i class="fa fa-angle-right"></i>'.$v0['categoryarea_name'].'</a>
                                            <ul class="dropdown-menu" style="'.$display.'">';
            foreach ( $v0['category'] as $k1 => $v1) {
                echo '<li><a href="javascript:void(0);"><i class="fa fa-caret-right"></i>'.$v1['category_name'].'</a></li>';
            }
            echo '</ul>
                                    </li>';
        }
        ?>
    </ul>
</div>