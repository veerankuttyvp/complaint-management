<div class="tab-pane active" id="side-tab-menu">
                    <!-- Primary Navigation -->
                    <nav id="primary-nav">
                        <ul>
                           <?php if($this->Acl->check('Dashboards','cmc') == true){ ?>
                            <li>
                                <a href="<?php echo $this->Html->url("/dashboards/cmc",true); ?>"><i class="gi gi-display"></i>Dashboard</a>
                            </li>
                            <?php } ?>
                            <?php if($this->Acl->check('Dashboards','subdivisions') == true){ ?>
                            <li>
                                <a href="<?php echo $this->Html->url("/dashboards/subdivisions",true); ?>"><i class="gi gi-display"></i>Dashboard(Sub)</a>
                            </li>
                            <?php } ?>
                            <?php if($this->Acl->check('Complaints','cmc_operator_latest') == true){ ?>
                            <li>
                                <a  href="<?php echo $this->Html->url("/complaints/cmc_operator_latest",true); ?>"><i class="gi gi-list"></i>Complaints</a>
                            </li>
                            <?php } ?>
                            <?php if($this->Acl->check('Complaints','subdivision_complaint') == true){ ?>
                            <li>
                                <a  href="<?php echo $this->Html->url("/complaints/subdivision_complaint",true); ?>"><i class="gi gi-list"></i>Complaints</a>
                            </li>
                            <?php } ?>
                            <?php if($this->Acl->check('Complaints','register') == true) { ?>
                            <li>
                                <a  href="<?php echo $this->Html->url("/complaints/register",true); ?>"><i class="gi gi-brush"></i>Register Complaint</a>
                            </li>
                            <?php } ?>
                            <?php if($this->Acl->check('Complaints','subdivisioncomplaint') == true) { ?>
                            <li>
                                <a  href="<?php echo $this->Html->url("/complaints/subdivisioncomplaint",true); ?>"><i class="gi gi-brush"></i>Register Complaint(Sub)</a>
                            </li>
                            <?php } ?>
                            <li>
                                <a href="#" class="menu-link"><i class="gi gi-display"></i>Reports</a>
                                <ul>
                                     <?php if($this->Acl->check('Complaints','generate_report') == true){ ?>
                                    <li>
                                        <a href="<?php echo $this->Html->url("/complaints/generate_report",true); ?>">General</a>
                                    </li>
                                     <?php } ?>
                                    <?php if($this->Acl->check('Complaints','simple_report') == true){ ?>
                                    <li>
                                        <a href="<?php echo $this->Html->url("/complaints/simple_report",true); ?>">Subdivision Wise</a>
                                    </li>
                                     <?php } ?>
                                    <?php if($this->Acl->check('Complaints','subdivision_report') == true){ ?>
                                    <li>
                                        <a href="<?php echo $this->Html->url("/complaints/subdivision_report",true); ?>">Stats Report</a>
                                    </li>
                                     <?php } ?>
                                    <?php if($this->Acl->check('Dashboards','report') == true){ ?>
                                    <li>
                                        <a href="<?php echo $this->Html->url("/dashboards/report",true); ?>">Previous Report</a>
                                    </li>
                                     <?php } ?>
                                    
                                </ul>
                            </li>
                             <?php if($this->Acl->check('Subdivisions','index') == true){ ?>
                            <li>
                                <a  href="<?php echo $this->Html->url("/subdivisions/",true); ?>"><i class="gi gi-display"></i>Subdivision</a>
                            </li>
                             <?php } ?>
                            <?php if($this->Acl->check('MobileUsers','index') == true){ ?>
                            <li>
                                <a  href="<?php echo $this->Html->url("/mobile_users/",true); ?>"><i class="gi gi-display"></i>Mobile Users</a>
                            </li>
                            <?php } ?>
                            
                            <?php if($this->Acl->check('MobilePhones','index') == true){ ?>
                            <li>
                                <a  href="<?php echo $this->Html->url("/mobile_phones/",true); ?>"><i class="gi gi-display"></i>Mobile Phones</a>
                            </li>
                            <?php } ?>
                           
                            <?php if($this->Acl->check('Categories','index') == true){ ?>
                            <li>
                                <a  href="<?php echo $this->Html->url("/categories/",true); ?>"><i class="gi gi-display"></i>Complaint Categories</a>
                            </li>
                            <?php } ?>
                            
                           
                            
                            
                            <?php if($this->Acl->check('Users','index','AuthAcl') == true){ ?>
                            <li>
                                <a href="<?php echo $this->Html->url("/auth_acl/users",true); ?>"><i class="gi gi-display"></i>User Management</a>
                            </li>
                            <?php } ?>
                           
                            
                            
                        </ul>
                    </nav>
                    <!-- END Primary Navigation -->
</div>