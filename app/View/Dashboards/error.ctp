<!-- Breadcrumb -->
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
      $this->Html->addCrumb("Dashboards",'javascript:void(0)');
    ?>
<!-- END Breadcrumb -->
                    <!-- 404 Error -->
                    <div id="error-tabs-404" class="tab-pane active">
                        <div class="error-container">
                            <div class="error-text">Page not found!</div>
                            <div class="error-code text-danger"><i class="icon-warning-sign"></i> 404</div>
                            <form action="page_ready_search_results.html" method="post" class="error-search">
                                <div class="input-group input-group-lg">
                                    <!-- <input type="text" id="example-error-search4" name="example-error-search4" class="form-control" placeholder="Search.."> -->
                                    <span class="input-group-btn">
                                        <button class="btn btn-default"><i class="icon-search"></i></button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END 404 Error -->