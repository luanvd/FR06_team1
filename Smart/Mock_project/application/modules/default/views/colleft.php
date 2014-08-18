<!--Col-left-->
    <script type="text/javascript">
        $(document).ready(function($){
    		$('#accordion-1').dcAccordion({
    			eventType: 'click',
    			autoClose: true,
    			saveState: true,
    			disableLink: true,
    			speed: 'slow',
    			showCount: true,
    			autoExpand: true,
    			cookie	: 'dcjq-accordion-1',
    			classExpand	 : 'dcjq-current-parent'
    		});
        });
    </script>
    
    <div class="colleft">
        <div class="title">Categories</div>
        <div id="menu_left">
            <div class="graphite demo-container">
                <ul class="accordion" id="accordion-1">
                    <li><a href="#" class="fa fa-chevron-right">&nbsp;Home</a></li>
                    <li class="dcjq-current-parent"><a href="#" class="fa fa-chevron-right">&nbsp;Products</a>
                        <ul id="child">
                            <li class="dcjq-current-parent"><a href="#" class="fa fa-chevron-right">&nbsp;SmartPhone</a>
                                <ul id="child">
                                    <li><a href="#" class="fa fa-chevron-right">&nbsp;Android</a></li>
                                </ul>
                            </li>
                            <li class="dcjq-current-parent"><a href="#" class="fa fa-chevron-right">&nbsp;Others</a>
                                <ul id="child">
                                    <li><a href="#" class="fa fa-chevron-right">&nbsp;IOS</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#" class="fa fa-chevron-right">&nbsp;Services</a></li>
                    <li><a href="#" class="fa fa-chevron-right">&nbsp;About Us</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!--End col-left-->