<aside id="page-sidebar" class="collapse navbar-collapse sticky navbar-main-collapse">
    <div class="side-scrollable">
        <!-- Mini Profile -->
        <div class="mini-profile">
            <div class="mini-profile-options">
               
                <a href="<?php echo $this->Html->url("/user/logout",true); ?>" class="badge badge-danger" data-toggle="tooltip" data-placement="right" title="Log out">
                    <i class="fa fa-sign-out"></i>
                </a>
            </div>
            <a href="#">
                <img src="<?php echo $this->Html->url("/img/logo.gif",true) ?>" alt="Avatar" class="img-circle">
            </a>
        </div>
        <!-- END Mini Profile -->
        
        <!-- Sidebar Tabs -->
        <div class="sidebar-tabs-con">
            <ul class="sidebar-tabs" data-toggle="tabs">
                <li class="active">
                    <a href="#side-tab-menu"><i class="gi gi-list"></i></a>
                </li>
               <!-- <li>
                    <a href="#side-tab-extra"><i class="gi gi-charts"></i></a>
                </li> -->
            </ul>
            <div class="tab-content">
                <?php $group_name = Cache::read('group_name'); ?>
                <?php 
                /*if($group_name == null){
                    
                }else if($group_name == 'CMC'){
                    echo $this->element('SideBarViews/cmc');
                }else if($group_name == 'Administrator'){
                    echo $this->element('SideBarViews/admin');
                }else if($group_name == 'Manager'){
                    echo $this->element('SideBarViews/admin');
                }else if($group_name == 'Subdivision'){
                    echo $this->element('SideBarViews/subdivision');
                }*/
                echo $this->element('SideBarViews/MainView');
                ?>
                <div class="tab-pane tab-pane-side" id="side-tab-extra">
                    <h5><i class="fa fa-briefcase pull-right"></i><a href="javascript:void(0)" class="side-link">Balance</a></h5>
                    <div>$25.230,00</div>
                                    
                    <h5><i class="fa fa-dollar pull-right"></i><a href="javascript:void(0)" class="side-link">Earnings (today)</a></h5>
                    <div>$1.752,00</div>
                                    
                    <h5><i class="fa fa-shopping-cart pull-right"></i><a href="javascript:void(0)" class="side-link">Sales (today)</a></h5>
                    <div>368</div>
                                    
                    <h5><i class="fa fa-shopping-cart pull-right"></i><a href="javascript:void(0)" class="side-link">Sales (this month)</a></h5>
                    <div class="text-success">+38%</div>
                                    
                    <h5><i class="fa fa-ticket pull-right"></i><a href="javascript:void(0)" class="side-link">Open Tickets</a></h5>
                    <div>23</div>
                                    
                    <h5><i class="fa fa-bug pull-right"></i><a href="javascript:void(0)" class="side-link">Bugs to fix</a></h5>
                    <div>2 important</div>
                    <div>5 normal</div>
                </div>
            </div>
        </div>
        <!--End Sidebar Tabs -->
    </div>
</aside>