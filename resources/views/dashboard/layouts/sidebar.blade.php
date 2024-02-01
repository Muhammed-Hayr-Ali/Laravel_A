        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="@yield('dashboard')">
                            <a href="{{ route('/index') }}"><img
                                    src="{{ asset('dashboard/assets/img/icons/dashboard.svg') }}" alt="img"><span>
                                    {{ __('sidebar.Dashboard') }}</span> </a>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img
                                    src="{{ asset('dashboard/assets/img/icons/product.svg') }}" alt="img"><span>
                                    {{ __('sidebar.Product') }}</span> <span class="menu-arrow"></span></a>
                            <ul>

                                <li>
                                    <a href="{{ route('Product.index') }}"
                                        class="@yield('productsList')">{{ __('sidebar.Products List') }}</a>
                                </li>

                                <li>
                                    <a href="{{ route('Product.create') }}"
                                        class="@yield('addProduct')">{{ __('sidebar.Add Product') }}</a>
                                </li>

                                <li>
                                    <a href="{{ route('Category.index') }}"
                                        class="@yield('categoriesList')">{{ __('sidebar.Category list') }}</a>
                                </li>

                                <li><a href="{{ route('Category.create') }}"
                                        class="@yield('addCategory')">{{ __('sidebar.Add Category') }}</a>
                                </li>
                                <li><a href="subcategorylist.html">{{ __('sidebar.Sub Category List') }}</a></li>
                                <li><a href="subaddcategory.html">{{ __('sidebar.Add Sub Category') }}</a></li>
                                <li><a href="brandlist.html">{{ __('sidebar.Brand List') }}</a></li>
                                <li><a href="addbrand.html">{{ __('sidebar.Add Brand') }}</a></li>
                                <li><a href="importproduct.html">{{ __('sidebar.Import Products') }}</a></li>
                                <li><a href="barcode.html">{{ __('sidebar.Print Barcode') }}</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img
                                    src="{{ asset('dashboard/assets/img/icons/sales1.svg') }}" alt="img"><span>
                                    {{ __('sidebar.Sales') }}</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="saleslist.html">{{ __('sidebar.Sales List') }}</a></li>
                                <li><a href="pos.html">{{ __('sidebar.POS') }}</a></li>
                                <li><a href="pos.html">{{ __('sidebar.New Sales') }}</a></li>
                                <li><a href="salesreturnlists.html">{{ __('sidebar.Sales Return List') }}</a></li>
                                <li><a href="createsalesreturns.html">{{ __('sidebar.New Sales Return') }}</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img
                                    src="{{ asset('dashboard/assets/img/icons/purchase1.svg') }}" alt="img"><span>
                                    {{ __('sidebar.Purchase') }}</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="purchaselist.html">{{ __('sidebar.Purchase List') }}</a></li>
                                <li><a href="addpurchase.html">{{ __('sidebar.Add Purchase Return') }}</a></li>
                                <li><a href="importpurchase.html">{{ __('sidebar.Import Purchase') }}</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img
                                    src="{{ asset('dashboard/assets/img/icons/expense1.svg') }}" alt="img"><span>
                                    {{ __('sidebar.Expense') }}</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="expenselist.html">{{ __('sidebar.Expense List') }}</a></li>
                                <li><a href="createexpense.html">{{ __('sidebar.Add Expense') }}</a></li>
                                <li><a href="expensecategory.html">{{ __('sidebar.Expense Category') }}</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img
                                    src="{{ asset('dashboard/assets/img/icons/quotation1.svg') }}"
                                    alt="img"><span>
                                    {{ __('sidebar.Quotation') }}</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="quotationList.html">{{ __('sidebar.Quotation List') }}</a></li>
                                <li><a href="addquotation.html">{{ __('sidebar.Add Quotation') }}</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img
                                    src="{{ asset('dashboard/assets/img/icons/transfer1.svg') }}" alt="img"><span>
                                    {{ __('sidebar.Transfer') }}</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="transferlist.html">{{ __('sidebar.Transfer List') }}</a></li>
                                <li><a href="addtransfer.html">{{ __('sidebar.Add Transfer') }}</a></li>
                                <li><a href="importtransfer.html">{{ __('sidebar.Import Transfer') }} </a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img
                                    src="{{ asset('dashboard/assets/img/icons/return1.svg') }}" alt="img"><span>
                                    {{ __('sidebar.Return') }}</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="salesreturnlist.html">{{ __('sidebar.Sales Return List') }}</a></li>
                                <li><a href="createsalesreturn.html">{{ __('sidebar.Add Sales Return') }} </a></li>
                                <li><a href="purchasereturnlist.html">{{ __('sidebar.Purchase Return List') }}</a></li>
                                <li><a href="createpurchasereturn.html">{{ __('sidebar.Add Purchase Return') }}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img
                                    src="{{ asset('dashboard/assets/img/icons/users1.svg') }}" alt="img"><span>
                                    {{ __('sidebar.People') }}</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="customerlist.html">{{ __('sidebar.Customer List') }}</a></li>
                                <li><a href="addcustomer.html">{{ __('sidebar.Add Customer') }} </a></li>
                                <li><a href="supplierlist.html">{{ __('sidebar.Supplier List') }}</a></li>
                                <li><a href="addsupplier.html">{{ __('sidebar.Add Supplier') }} </a></li>
                                <li><a href="userlist.html">{{ __('sidebar.User List') }}</a></li>
                                <li><a href="adduser.html">{{ __('sidebar.Add User') }}</a></li>
                                <li><a href="storelist.html">{{ __('sidebar.Store List') }}</a></li>
                                <li><a href="addstore.html">{{ __('sidebar.Add Store') }}</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img
                                    src="{{ asset('dashboard/assets/img/icons/places.svg') }}" alt="img"><span>
                                    {{ __('sidebar.Places') }}</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="newcountry.html">{{ __('sidebar.New Country') }}</a></li>
                                <li><a href="countrieslist.html">{{ __('sidebar.Countries list') }}</a></li>
                                <li><a href="newstate.html">{{ __('sidebar.New State') }} </a></li>
                                <li><a href="statelist.html">{{ __('sidebar.State list') }}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="components.html"><i data-feather="layers"></i><span> Components</span> </a>
                        </li>
                        <li>
                            <a href="blankpage.html"><i data-feather="file"></i><span> Blank Page</span> </a>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i data-feather="alert-octagon"></i> <span> Error Pages
                                </span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="error-404.html">404 Error </a></li>
                                <li><a href="error-500.html">500 Error </a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i data-feather="box"></i> <span>Elements </span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="sweetalerts.html">Sweet Alerts</a></li>
                                <li><a href="tooltip.html">Tooltip</a></li>
                                <li><a href="popover.html">Popover</a></li>
                                <li><a href="ribbon.html">Ribbon</a></li>
                                <li><a href="clipboard.html">Clipboard</a></li>
                                <li><a href="drag-drop.html">Drag & Drop</a></li>
                                <li><a href="rangeslider.html">Range Slider</a></li>
                                <li><a href="rating.html">Rating</a></li>
                                <li><a href="toastr.html">Toastr</a></li>
                                <li><a href="text-editor.html">Text Editor</a></li>
                                <li><a href="counter.html">Counter</a></li>
                                <li><a href="scrollbar.html">Scrollbar</a></li>
                                <li><a href="spinner.html">Spinner</a></li>
                                <li><a href="notification.html">Notification</a></li>
                                <li><a href="lightbox.html">Lightbox</a></li>
                                <li><a href="stickynote.html">Sticky Note</a></li>
                                <li><a href="timeline.html">Timeline</a></li>
                                <li><a href="form-wizard.html">Form Wizard</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i data-feather="bar-chart-2"></i> <span> Charts </span>
                                <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="chart-apex.html">Apex Charts</a></li>
                                <li><a href="chart-js.html">Chart Js</a></li>
                                <li><a href="chart-morris.html">Morris Charts</a></li>
                                <li><a href="chart-flot.html">Flot Charts</a></li>
                                <li><a href="chart-peity.html">Peity Charts</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i data-feather="award"></i><span> Icons </span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="icon-fontawesome.html">Fontawesome Icons</a></li>
                                <li><a href="icon-feather.html">Feather Icons</a></li>
                                <li><a href="icon-ionic.html">Ionic Icons</a></li>
                                <li><a href="icon-material.html">Material Icons</a></li>
                                <li><a href="icon-pe7.html">Pe7 Icons</a></li>
                                <li><a href="icon-simpleline.html">Simpleline Icons</a></li>
                                <li><a href="icon-themify.html">Themify Icons</a></li>
                                <li><a href="icon-weather.html">Weather Icons</a></li>
                                <li><a href="icon-typicon.html">Typicon Icons</a></li>
                                <li><a href="icon-flag.html">Flag Icons</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i data-feather="columns"></i> <span> Forms </span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="form-basic-inputs.html">Basic Inputs </a></li>
                                <li><a href="form-input-groups.html">Input Groups </a></li>
                                <li><a href="form-horizontal.html">Horizontal Form </a></li>
                                <li><a href="form-vertical.html"> Vertical Form </a></li>
                                <li><a href="form-mask.html">Form Mask </a></li>
                                <li><a href="form-validation.html">Form Validation </a></li>
                                <li><a href="form-select2.html">Form Select2 </a></li>
                                <li><a href="form-fileupload.html">File Upload </a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i data-feather="layout"></i> <span> Table </span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="tables-basic.html">Basic Tables </a></li>
                                <li><a href="data-tables.html">Data Table </a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img
                                    src="{{ asset('dashboard/assets/img/icons/product.svg') }}" alt="img"><span>
                                    {{ __('sidebar.Application') }}</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="chat.html">{{ __('sidebar.Chat') }}</a></li>
                                <li><a href="calendar.html">{{ __('sidebar.Calendar') }}</a></li>
                                <li><a href="email.html">{{ __('sidebar.Email') }}</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img
                                    src="{{ asset('dashboard/assets/img/icons/time.svg') }}" alt="img"><span>
                                    {{ __('sidebar.Report') }}</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="purchaseorderreport.html">{{ __('sidebar.Purchase order report') }}</a>
                                </li>
                                <li><a href="inventoryreport.html">{{ __('sidebar.Inventory Report') }}</a></li>
                                <li><a href="salesreport.html">{{ __('sidebar.Sales Report') }}</a></li>
                                <li><a href="invoicereport.html">{{ __('sidebar.Invoice Report') }}</a></li>
                                <li><a href="purchasereport.html">{{ __('sidebar.Purchase Report') }}</a></li>
                                <li><a href="supplierreport.html">{{ __('sidebar.Supplier Report') }}</a></li>
                                <li><a href="customerreport.html">{{ __('sidebar.Customer Report') }}</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img
                                    src="{{ asset('dashboard/assets/img/icons/users1.svg') }}" alt="img"><span>
                                    {{ __('sidebar.Users') }}</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="newuser.html">{{ __('sidebar.New User') }} </a></li>
                                <li><a href="userlists.html">{{ __('sidebar.Users List') }}</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img
                                    src="{{ asset('dashboard/assets/img/icons/settings.svg') }}"
                                    alt="img"><span>
                                    {{ __('sidebar.Settings') }}</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="generalsettings.html">{{ __('sidebar.General Settings') }}</a></li>
                                <li><a href="emailsettings.html">{{ __('sidebar.Email Settings') }}</a></li>
                                <li><a href="paymentsettings.html">{{ __('sidebar.Payment Settings') }}</a></li>
                                <li><a href="currencysettings.html">{{ __('sidebar.Currency Settings') }}</a></li>
                                <li><a href="grouppermissions.html">{{ __('sidebar.Group Permissions') }}</a></li>
                                <li><a href="taxrates.html">{{ __('sidebar.Tax Rates') }}</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
